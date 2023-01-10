<?php

declare(strict_types=1);

namespace Slakbal\Oauth\Contracts;

interface OauthContract
{
    public function ping();

    public function redirectToProvider($provider);

    public function user($provider);
}
