<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use http\Exception\InvalidArgumentException;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/callback', function (Request $request) {
    /**
     * @var $request Request&object{
     *     state:string,
     *     code:string
     * }
     */

    $state = $request->session()->pull('state');

    $codeVerifier = $request->session()->pull('code_verifier');

    throw_unless(
        $state !== '' && $state === $request->state,
        InvalidArgumentException::class,
    );

    $response = Http::asForm()->post('http://auth.ates.test/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('CLIENT_ID'),
        'redirect_uri' => 'http://tasks.ates.test:8080/auth/callback',
        'code_verifier' => $codeVerifier,
        'code' => $request->code,
    ]);

    if ($response->successful()) {
        $accessToken = $response->json('access_token');
        $response = Http::withHeader('Authorization', 'Bearer ' . $accessToken)
            ->get('http://auth.ates.test/api/user');

        if ($response->successful()) {
            $userId = $response->json('id');
            /** @var User $user */
            $user = User::query()->findOrNew($userId);
            $user->save();

            Auth::login($user);
            return redirect(route('test'));
        }
        return $response->json();
    }

    return $response->json();
})->middleware('web');
