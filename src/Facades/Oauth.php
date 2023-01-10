<?php

namespace Slakbal\Oauth\Facades;

use Illuminate\Support\Facades\Facade;
use Slakbal\Oauth\Contracts\OauthContract;

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
        return OauthContract::class;
    }
}
