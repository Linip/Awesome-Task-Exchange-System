<?php

namespace App\Models;


use Laravel\Passport\Client;

class OAuthClient extends Client
{
    /**
     * @inheritDoc
     * @see https://laravel.su/docs/8.x/passport#podtverzdenie-zaprosa
     * @return bool
     */
    public function skipsAuthorization(): bool
    {
        return true;
    }
}
