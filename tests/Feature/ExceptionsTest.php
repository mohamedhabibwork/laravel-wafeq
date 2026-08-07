<?php

use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\RateLimitException;
use HWafeq\LaravelWafeq\Exceptions\ServerException;
use HWafeq\LaravelWafeq\Exceptions\ValidationException;
use HWafeq\LaravelWafeq\Exceptions\WafeqException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use Illuminate\Support\Facades\Http;

it('maps 401 to AuthenticationException', function () {
    Http::fake([
        'api-sandbox.wafeq.com/*' => Http::response(['detail' => 'Unauthorized'], 401),
    ]);

    LaravelWafeq::invoices()->list();
})->throws(AuthenticationException::class);

it('maps 404 to NotFoundException', function () {
    Http::fake([
        'api-sandbox.wafeq.com/v1/invoices/inv_missing/*' => Http::response(['detail' => 'Not found'], 404),
    ]);

    LaravelWafeq::invoices()->retrieve('inv_missing');
})->throws(NotFoundException::class);

it('maps 422 to ValidationException with errors bag', function () {
    Http::fake([
        'api-sandbox.wafeq.com/v1/invoices/*' => Http::response([
            'detail' => 'Invalid input.',
            'errors' => ['currency' => ['This field is required.']],
        ], 422),
    ]);

    try {
        LaravelWafeq::invoices()->create([]);
    } catch (ValidationException $e) {
        expect($e->errors())->toBe(['currency' => ['This field is required.']])
            ->and($e->statusCode)->toBe(422);

        return;
    }

    test()->fail('Expected ValidationException');
});

it('maps 429 to RateLimitException', function () {
    Http::fake([
        'api-sandbox.wafeq.com/*' => Http::response(['detail' => 'Too many requests'], 429, ['Retry-After' => '60']),
    ]);

    LaravelWafeq::invoices()->list();
})->throws(RateLimitException::class);

it('maps 500 to ServerException', function () {
    Http::fake([
        'api-sandbox.wafeq.com/*' => Http::response(['detail' => 'Server error'], 500),
    ]);

    LaravelWafeq::invoices()->list();
})->throws(ServerException::class);

it('throws WafeqException as the base type', function () {
    Http::fake([
        'api-sandbox.wafeq.com/*' => Http::response(['detail' => 'Teapot'], 418),
    ]);

    LaravelWafeq::invoices()->list();
})->throws(WafeqException::class);
