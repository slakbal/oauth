<?php

namespace Slakbal\Oauth;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Contracts\Support\DeferrableProvider;
use Slakbal\Oauth\Providers\SivProvider;

class OauthServiceProvider extends ServiceProvider //implements DeferrableProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        // dd('x');
        // Automatically apply the package configuration,
        // so that is not really required to be published
        $this->mergeConfigFrom(__DIR__.'/../config/oauth.php', 'oauth');

        // Register the main class to use with the facade
        $this->app->bind('oauth', function ($app, $parameters) {
            dd(new Oauth());
            return new Oauth();
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        // dd('y');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/oauth.php' => config_path('oauth.php'),
            ], 'config');
        } else {
            $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');

            $socialite->extend(
                'siv',
                function ($app) use ($socialite) {
                    //NOTE: This uses tenant() which is a helper in the main multi-tenancy application
                    $config = $app['config']['services.'.tenant()->type->getValueLower()];

                    return $socialite->buildProvider(SIVProvider::class, $config);
                }
            );
        }
    }
}
