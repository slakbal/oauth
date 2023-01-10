<?php

declare(strict_types=1);

namespace Slakbal\Oauth\Contracts;

interface OauthContract
{
    public function ping(): string;

    public function redirectToProvider(string $provider): \Symfony\Component\HttpFoundation\RedirectResponse;

    public function user(string $provider): \Laravel\Socialite\Contracts\User;
}
