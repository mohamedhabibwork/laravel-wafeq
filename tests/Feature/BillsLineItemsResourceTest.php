<?php

use HWafeq\LaravelWafeq\Data\BillLineItemData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists bills line items', function () {
    $this->fakeWafeqPage('/bills/line-items/', [
        ['id' => 'bli_1', 'name' => 'Consulting', 'quantity' => '10', 'price' => '100.00', 'total' => '1000.00', 'account' => 'acc_1'],
    ]);

    $page = LaravelWafeq::billsLineItems()->list();

    expect($page->results[0])->toBeInstanceOf(BillLineItemData::class)
        ->and($page->results[0]->name)->toBe('Consulting');
});

it('creates a bills line item', function () {
    $this->fakeWafeq('/bills/line-items/', ['id' => 'bli_new', 'name' => 'Service', 'quantity' => '1', 'price' => '500.00', 'total' => '500.00']);

    $li = LaravelWafeq::billsLineItems()->create([
        'bill' => 'b_1',
        'name' => 'Service',
        'quantity' => '1',
        'price' => '500.00',
        'account' => 'acc_1',
    ]);

    expect($li->id)->toBe('bli_new');
});

it('retrieves a bills line item', function () {
    $this->fakeWafeq('/bills/line-items/bli_1/', ['id' => 'bli_1', 'name' => 'Consulting', 'quantity' => '10', 'price' => '100.00', 'total' => '1000.00']);

    $li = LaravelWafeq::billsLineItems()->retrieve('bli_1');

    expect($li->id)->toBe('bli_1');
});

it('updates a bills line item', function () {
    $this->fakeWafeq('/bills/line-items/bli_1/', ['id' => 'bli_1', 'name' => 'Updated', 'quantity' => '10', 'price' => '100.00', 'total' => '1000.00']);

    $li = LaravelWafeq::billsLineItems()->update('bli_1', ['name' => 'Updated']);

    expect($li->name)->toBe('Updated');
});

it('partial updates a bills line item', function () {
    $this->fakeWafeq('/bills/line-items/bli_1/', ['id' => 'bli_1', 'name' => 'Consulting', 'quantity' => '20', 'price' => '100.00', 'total' => '2000.00']);

    $li = LaravelWafeq::billsLineItems()->partialUpdate('bli_1', ['quantity' => '20']);

    expect($li->quantity)->toBe('20');
});

it('destroys a bills line item', function () {
    $this->fakeWafeq('/bills/line-items/bli_1/', '', 204);

    expect(LaravelWafeq::billsLineItems()->destroy('bli_1'))->toBeTrue();
});
