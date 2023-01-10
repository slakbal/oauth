<?php

namespace Slakbal\Oauth\Facades;

use Illuminate\Support\Facades\Facade;

final class Auth extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'oauth';
        // return Auth::class;
    }
}
