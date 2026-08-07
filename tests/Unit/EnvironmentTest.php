<?php

use HWafeq\LaravelWafeq\Enums\Environment;

it('exposes the sandbox base URL', function () {
    expect(Environment::Sandbox->baseUrl())->toBe('https://api-sandbox.wafeq.com/v1');
});

it('exposes the production base URL', function () {
    expect(Environment::Production->baseUrl())->toBe('https://api.wafeq.com/v1');
});

it('can be created from a string value', function () {
    expect(Environment::from('sandbox'))->toBe(Environment::Sandbox);
    expect(Environment::from('production'))->toBe(Environment::Production);
});
