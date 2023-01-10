<?php

namespace Slakbal\Oauth\Facades;

use Illuminate\Support\Facades\Facade;
use Slakbal\Oauth\Contracts\OauthContract;

// use Slakbal\Oauth\Manager\OauthManager;

final class Oauth extends Facade
{
    /**
     * Get the registered component.
     *
     * @return string
     * @see \Slakbal\Oauth\OauthManager;
     */
    protected static function getFacadeAccessor(): string
    {
        // return 'oauth';
        // return OauthManager::class;
        return OauthContract::class;
    }
}
