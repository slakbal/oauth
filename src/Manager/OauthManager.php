<?php

namespace Slakbal\Oauth\Manager;

use Laravel\Socialite\Facades\Socialite;
use Slakbal\Oauth\Contracts\OauthContract;
use Slakbal\Oauth\Exceptions\AuthException;

class OauthManager implements OauthContract
{
    public function ping(): string
    {
        return 'Pong';
    }

    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider(string $provider): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver($this->providerAllowed($provider))->redirect();
    }

    public function user(string $provider): \Laravel\Socialite\Contracts\User
    {
        return Socialite::driver($this->providerAllowed($provider))->user();
    }

    private function providerAllowed(string $provider): string
    {
        $provider = $this->sanitizeValue($provider);

        if (! in_array($provider, config('oauth.providers.allowed'))) {
            throw AuthException::providerNotSupported($provider);
        }

        return $provider;
    }

    private function sanitizeValue(string $value): string
    {
        return strtolower(trim($value));
    }
}
