<?php

namespace Slakbal\Oauth;

use Illuminate\Support\ServiceProvider;
use Slakbal\Oauth\Providers\SivProvider;

class OauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->bootSivProvider();

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/oauth.php' => config_path('oauth.php'),
            ], 'config');
        }
    }

    protected function bootSivProvider()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');

        $socialite->extend(
            'siv',
            function ($app) use ($socialite) {
                $config = $app['config']['services.siv'];

                return $socialite->buildProvider(SIVProvider::class, $config);
            }
        );
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration, 
        // so that is not really required to be published
        $this->mergeConfigFrom(__DIR__.'/../config/oauth.php', 'oauth');

        // Register the main class to use with the facade
        $this->app->bind('oauth', function () {
            return new Oauth();
        });
    }
}
