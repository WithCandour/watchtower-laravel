<?php

namespace Watchtower\WatchtowerLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Watchtower\WatchtowerLaravel\Commands\WatchtowerLaravelCommand;
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
            ->hasCommand(WatchtowerLaravelCommand::class);
    }

    public function boot(): void
    {
        parent::boot();

        $this->app['router']->pushMiddlewareToGroup('web', Watchtower::class);
    }
}
