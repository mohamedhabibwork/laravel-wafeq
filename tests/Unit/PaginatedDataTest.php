<?php

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use Illuminate\Http\Client\Response;

it('hydrates from a Laravel HTTP response', function () {
    $response = new Response(new GuzzleHttp\Psr7\Response(
        200,
        [],
        json_encode([
            'count' => 2,
            'next' => 'https://api.wafeq.com/v1/accounts/?page=2',
            'previous' => null,
            'results' => [
                ['id' => 'acc_1', 'name' => 'Cash', 'code' => '1000'],
                ['id' => 'acc_2', 'name' => 'Bank', 'code' => '1100'],
            ],
        ]),
    ));

    $page = PaginatedData::fromResponse($response, AccountData::class);

    expect($page->count)->toBe(2)
        ->and($page->hasMore())->toBeTrue()
        ->and($page->results)->toHaveCount(2)
        ->and($page->results[0])->toBeInstanceOf(AccountData::class);
});

it('reports no more pages when next is null', function () {
    $response = new Response(new GuzzleHttp\Psr7\Response(
        200,
        [],
        json_encode(['count' => 0, 'next' => null, 'previous' => null, 'results' => []]),
    ));

    $page = PaginatedData::fromResponse($response, AccountData::class);

    expect($page->hasMore())->toBeFalse()
        ->and($page->count)->toBe(0);
});
