<?php

use HWafeq\LaravelWafeq\Data\QuoteLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists quotes line items', function () {
    $this->fakeWafeqPage('/quotes/line-items/', [
        ['id' => 'qli_1', 'name' => 'Service', 'quantity' => '1', 'price' => '1000.00', 'total' => '1000.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::quotesLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(QuoteLineItemData::class);
});

it('creates a quotes line item', function () {
    $this->fakeWafeq('/quotes/line-items/', ['id' => 'qli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::quotesLineItems()->create([
        'quote' => 'q_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '500.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('qli_new');
});

it('retrieves a quotes line item', function () {
    $this->fakeWafeq('/quotes/line-items/qli_1/', ['id' => 'qli_1', 'name' => 'Service', 'quantity' => '1', 'price' => '1000.00', 'total' => '1000.00']);

    $li = LaravelWafeq::quotesLineItems()->retrieve('qli_1');

    expect($li->id)->toBe('qli_1');
});

it('updates a quotes line item', function () {
    $this->fakeWafeq('/quotes/line-items/qli_1/', ['id' => 'qli_1', 'name' => 'Updated', 'quantity' => '1', 'price' => '1000.00', 'total' => '1000.00']);

    $li = LaravelWafeq::quotesLineItems()->update('qli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates a quotes line item', function () {
    $this->fakeWafeq('/quotes/line-items/qli_1/', ['id' => 'qli_1', 'name' => 'Service', 'quantity' => '2', 'price' => '1000.00', 'total' => '2000.00']);

    $li = LaravelWafeq::quotesLineItems()->partialUpdate('qli_1', ['quantity' => '2']);

    expect($li->quantity)->toBe('2');
});

it('destroys a quotes line item', function () {
    $this->fakeWafeq('/quotes/line-items/qli_1/', '', 204);

    expect(LaravelWafeq::quotesLineItems()->destroy('qli_1'))->toBeTrue();
});
