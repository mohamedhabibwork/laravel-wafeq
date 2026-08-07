<?php

use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use Illuminate\Support\Facades\Http;

it('attaches an X-Wafeq-Idempotency-Key header on POST', function () {
    Http::fake([
        'api-sandbox.wafeq.com/v1/contacts*' => Http::response(['id' => 'c_1', 'name' => 'Acme'], 201),
    ]);

    LaravelWafeq::contacts()->create(['name' => 'Acme']);

    Http::assertSent(function ($request) {
        return $request->method() === 'POST'
            && $request->hasHeader('X-Wafeq-Idempotency-Key');
    });
});

it('does not attach an idempotency header on GET', function () {
    Http::fake([
        'api-sandbox.wafeq.com/v1/contacts*' => Http::response([
            'count' => 0,
            'next' => null,
            'previous' => null,
            'results' => [],
        ]),
    ]);

    LaravelWafeq::contacts()->list();

    Http::assertSent(function ($request) {
        return $request->method() === 'GET'
            && ! $request->hasHeader('X-Wafeq-Idempotency-Key');
    });
});
