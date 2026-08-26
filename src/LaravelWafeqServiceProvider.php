<?php

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Contracts\ClientContract;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
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

        // Wafeq's wire format is snake_case (e.g. `building_number`,
        // `tax_amount_type`) while our DTOs expose camelCase properties.
        // Tell Spatie Data to translate property names to snake_case
        // when looking up inputs and back to camelCase when outputting.
        /** @var Repository $config */
        $config = $this->app->make('config');
        $config->set('data.name_mapping_strategy.input', SnakeCaseMapper::class);
        $config->set('data.name_mapping_strategy.output', SnakeCaseMapper::class);
    }
}
