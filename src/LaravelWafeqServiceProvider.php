<?php

namespace HWafeq\LaravelWafeq;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use HWafeq\LaravelWafeq\Commands\LaravelWafeqCommand;

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
}
