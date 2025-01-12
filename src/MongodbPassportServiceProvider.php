<?php

namespace Medusa\Mongodb;

use Illuminate\Support\ServiceProvider;
use Medusa\Mongodb\Passport\AuthCode;
use Medusa\Mongodb\Passport\Bridge\RefreshTokenRepository;
use Medusa\Mongodb\Passport\Client;
use Medusa\Mongodb\Passport\PersonalAccessClient;
use Medusa\Mongodb\Passport\RefreshToken;
use Medusa\Mongodb\Passport\Token;
use Laravel\Passport\Bridge\RefreshTokenRepository as PassportRefreshTokenRepository;
use Laravel\Passport\Passport;

class MongodbPassportServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        Passport::useTokenModel(Token::class);

        $this->app->bind(PassportRefreshTokenRepository::class, function () {
            return $this->app->make(RefreshTokenRepository::class);
        });
    }
}
