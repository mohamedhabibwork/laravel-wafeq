<?php

use HWafeq\LaravelWafeq\Data\OrganizationData;
use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('retrieves the current organization', function () {
    $this->fakeWafeq('/organization/', [
        'id' => 'org_1',
        'name' => 'Acme Co.',
        'legalName' => 'Acme Co. WLL',
        'taxId' => '300123456700003',
        'country' => 'SA',
        'currency' => 'SAR',
        'timezone' => 'Asia/Riyadh',
    ]);

    $org = LaravelWafeq::organization()->retrieve();

    expect($org)->toBeInstanceOf(OrganizationData::class)
        ->and($org->id)->toBe('org_1')
        ->and($org->name)->toBe('Acme Co.')
        ->and($org->legalName)->toBe('Acme Co. WLL')
        ->and($org->currency)->toBe('SAR')
        ->and($org->country)->toBe('SA');
});

it('does not attach an idempotency header on retrieve', function () {
    $this->fakeWafeq('/organization/', ['id' => 'org_1', 'name' => 'Acme']);

    LaravelWafeq::organization()->retrieve();

    Http::assertSent(function ($request) {
        return $request->method() === 'GET' && ! $request->hasHeader('X-Wafeq-Idempotency-Key');
    });
});

it('throws AuthenticationException on 401', function () {
    $this->fakeAuthError('/organization/');

    LaravelWafeq::organization()->retrieve();
})->throws(AuthenticationException::class);

it('throws NotFoundException on 404', function () {
    $this->fakeNotFound('/organization/');

    LaravelWafeq::organization()->retrieve();
})->throws(NotFoundException::class);
