<?php

namespace Watchtower\WatchtowerLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Watchtower\WatchtowerLaravel\Commands\Ping;
use Watchtower\WatchtowerLaravel\Middleware\Watchtower;

class WatchtowerLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('watchtower-laravel')
            ->hasConfigFile()
            ->hasCommand(Ping::class);
    }

    public function boot(): void
    {
        parent::boot();

        // TODO: Bypass statamic static cacher to enable the middleware to be applied to the web group
        // $this->app['router']->pushMiddlewareToGroup('web', Watchtower::class);
        $this->app['router']->pushMiddlewareToGroup('statamic.cp', Watchtower::class);
    }
}
