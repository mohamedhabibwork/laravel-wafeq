<?php

namespace HWafeq\LaravelWafeq\Tests;

use HWafeq\LaravelWafeq\LaravelWafeqServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'HWafeq\LaravelWafeq\Database\Factories\\'.class_basename($modelName).'Factory'
        );

        $defaultDataConfig = require __DIR__.'/../vendor/spatie/laravel-data/config/data.php';

        config()->set('data', array_merge($defaultDataConfig, [
            'name_mapping_strategy' => [
                'input' => SnakeCaseMapper::class,
                'output' => SnakeCaseMapper::class,
            ],
            'structure_caching' => [
                'enabled' => false,
                'directories' => [],
                'cache' => ['store' => 'array', 'prefix' => 'laravel-data', 'duration' => null],
                'reflection_discovery' => ['enabled' => false, 'base_path' => base_path(), 'root_namespace' => null],
            ],
        ]));
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelWafeqServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('wafeq.api_key', 'test-key');
        config()->set('wafeq.environment', 'sandbox');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
