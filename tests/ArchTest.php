<?php

use HWafeq\LaravelWafeq\Resources\AccountsResource;

arch('it will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->each->not->toBeUsed();

arch('resources depend on contracts')
    ->expect('HWafeq\LaravelWafeq\Resources')
    ->toImplement('HWafeq\LaravelWafeq\Contracts\ResourceContract');

arch('contracts directory exists')
    ->expect('HWafeq\LaravelWafeq\Contracts')
    ->toBeInterfaces();

arch('data classes extend Spatie Data')
    ->expect('HWafeq\LaravelWafeq\Data')
    ->toExtend('Spatie\LaravelData\Data');

arch('enums are enums')
    ->expect('HWafeq\LaravelWafeq\Enums')
    ->toBeEnums();

arch('exceptions extend the base WafeqException')
    ->expect('HWafeq\LaravelWafeq\Exceptions')
    ->toExtend('HWafeq\LaravelWafeq\Exceptions\WafeqException');

arch('Client implements ClientContract')
    ->expect('HWafeq\LaravelWafeq\Client')
    ->toImplement('HWafeq\LaravelWafeq\Contracts\ClientContract');

it('has a fully wired client', function () {
    expect(class_exists(AccountsResource::class))->toBeTrue();
});
