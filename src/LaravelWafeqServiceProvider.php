<?php

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Contracts\ClientContract;
use Illuminate\Contracts\Foundation\Application;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

/**
 * LaravelWafeqServiceProvider Class.
 *
 * @see LaravelWafeq
 */
class LaravelWafeqServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-wafeq')
            ->hasConfigFile();
    }

    public function packageRegistered(): void
    {
        $this->app->singleton(Connector::class, function (Application $app): Connector {
            /** @var array<string, mixed> $config */
            $config = (array) $app->make('config')->get('wafeq', []);

            return new Connector($config);
        });

        $this->app->singleton(ClientContract::class, function (Application $app): ClientContract {
            return new Client($app->make(Connector::class));
        });

        $this->app->alias(ClientContract::class, 'laravel-wafeq');
    }
}
