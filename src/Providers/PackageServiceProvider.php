<?php

namespace Slakbal\Oauth\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Support\DeferrableProvider;
use Slakbal\Oauth\Contracts\OauthContract;
use Slakbal\Oauth\Manager\OauthManager;

class PackageServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
    * All of the container bindings that should be registered.
    *
    * @var array<class-string,class-string>
    */
    // public $bindings = [
    //     OauthContract::class => OauthManager::class,
    // ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        OauthContract::class => OauthManager::class,
    ];

    /**
     * Get the services provided by the provider. Needed for deferred service providers
     *
     * @return array
     */
    public function provides()
    {
        return [OauthContract::class];
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration,
        // so that is not really required to be published
        $this->mergeConfigFrom(__DIR__.'/../../config/oauth.php', 'oauth');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
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
