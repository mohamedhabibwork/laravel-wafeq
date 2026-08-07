<?php

use HWafeq\LaravelWafeq\Client;
use HWafeq\LaravelWafeq\Connector;
use HWafeq\LaravelWafeq\Contracts\AccountsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ClientContract;
use HWafeq\LaravelWafeq\Contracts\ContactsResourceContract;
use HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract;
use HWafeq\LaravelWafeq\Contracts\OrganizationResourceContract;
use HWafeq\LaravelWafeq\Contracts\PaymentsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ReportsResourceContract;
use HWafeq\LaravelWafeq\Enums\Environment;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;

it('binds the Client as a singleton', function () {
    $instance = app(ClientContract::class);

    expect($instance)->toBeInstanceOf(Client::class);
    expect(app(ClientContract::class))->toBe($instance);
});

it('resolves the client through the Facade', function () {
    expect(LaravelWafeq::getFacadeRoot())->toBeInstanceOf(ClientContract::class);
});

it('wires the connector with environment config', function () {
    config()->set('wafeq.environment', 'production');
    config()->set('wafeq.api_key', 'test-key');

    $connector = app(Connector::class);

    expect($connector->environment())->toBe(Environment::Production);
    expect($connector->baseUrl())->toBe('https://api.wafeq.com/v1');
    expect($connector->apiKey())->toBe('test-key');
});

it('falls back to sandbox by default', function () {
    config()->set('wafeq.environment', 'sandbox');

    $connector = app(Connector::class);

    expect($connector->environment())->toBe(Environment::Sandbox);
    expect($connector->baseUrl())->toBe('https://api-sandbox.wafeq.com/v1');
});

it('exposes every Resource factory on the Client', function () {
    $client = app(ClientContract::class);

    expect($client->organization())->toBeInstanceOf(OrganizationResourceContract::class);
    expect($client->accounts())->toBeInstanceOf(AccountsResourceContract::class);
    expect($client->invoices())->toBeInstanceOf(InvoicesResourceContract::class);
    expect($client->contacts())->toBeInstanceOf(ContactsResourceContract::class);
    expect($client->payments())->toBeInstanceOf(PaymentsResourceContract::class);
    expect($client->reports())->toBeInstanceOf(ReportsResourceContract::class);
});
