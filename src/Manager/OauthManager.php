<?php

namespace Slakbal\Oauth\Manager;

use Laravel\Socialite\Facades\Socialite;
use Slakbal\Oauth\Contracts\OauthContract;
use Slakbal\Oauth\Exceptions\AuthException;

class OauthManager implements OauthContract
{
    public function ping()
    {
        return 'Hallo World';
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($this->providerAllowed($provider))->redirect();
    }

    public function user($provider)
    {
        return Socialite::driver($this->providerAllowed($provider))->user();
    }

    private function providerAllowed($provider)
    {
        $provider = $this->sanitizeValue($provider);

        if (! in_array($provider, config('oauth.providers.allowed'))) {
            throw AuthException::providerNotSupported($provider);
        }

        return $provider;
    }

    private function sanitizeValue($value)
    {
        return strtolower(trim($value));
    }
}
