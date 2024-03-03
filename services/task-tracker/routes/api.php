<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['web', 'auth:web'])->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/dashboard', function (Request $request) {
        return 'Dashboard...';
    });

    Route::get('/test', function (Request $request) {
        return 'Success';
    })->name('test');
});

# http://tasks.ates.test:8080/api/redirect
# http://tasks.ates.test:8080/api/test
Route::name('login')->get('/redirect', static function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));

    // Предоставление кода авторизации с помощью PKCE
    // https://auth0.com/docs/get-started/authentication-and-authorization-flow/authorization-code-flow-with-pkce
    $request->session()->put('code_verifier', $code_verifier = Str::random(128));
    $codeChallenge = strtr(rtrim(
        base64_encode(hash('sha256', $code_verifier, true))
        , '='), '+/', '-_');

    $query = http_build_query([
        'client_id' => env('CLIENT_ID'),
        'redirect_uri' => 'http://tasks.ates.test:8080/auth/callback',
        'response_type' => 'code',
        'scope' => '*',
        'state' => $state,
        'code_challenge' => $codeChallenge,
        'code_challenge_method' => 'S256',
        'prompt' => 'login', // "none", "consent", or "login"
    ]);

    return redirect('http://auth.ates.test/oauth/authorize?' . $query);
})->middleware('web');
