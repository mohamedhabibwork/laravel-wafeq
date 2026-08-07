<?php

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\WafeqException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists contacts', function () {
    $this->fakeWafeqPage('/contacts/', [
        ['id' => 'c_1', 'name' => 'Acme Co.', 'type' => 'CUSTOMER', 'email' => 'billing@acme.test', 'currency' => 'SAR', 'country' => 'SA'],
        ['id' => 'c_2', 'name' => 'Vendor X', 'type' => 'VENDOR', 'email' => 'info@vendorx.test', 'currency' => 'SAR', 'country' => 'SA'],
    ]);

    $page = LaravelWafeq::contacts()->list();

    expect($page->count)->toBe(2)
        ->and($page->results[0])->toBeInstanceOf(ContactData::class)
        ->and($page->results[0]->type)->toBe('CUSTOMER')
        ->and($page->results[1]->type)->toBe('VENDOR');
});

it('creates a contact', function () {
    $this->fakeWafeq('/contacts/', ['id' => 'c_new', 'name' => 'New Contact', 'type' => 'CUSTOMER', 'email' => 'x@x.test', 'currency' => 'SAR']);

    $c = LaravelWafeq::contacts()->create(['name' => 'New Contact', 'type' => 'CUSTOMER']);

    expect($c->id)->toBe('c_new');
});

it('retrieves a contact', function () {
    $this->fakeWafeq('/contacts/c_1/', ['id' => 'c_1', 'name' => 'Acme Co.', 'type' => 'CUSTOMER', 'email' => 'billing@acme.test']);

    $c = LaravelWafeq::contacts()->retrieve('c_1');

    expect($c->email)->toBe('billing@acme.test');
});

it('updates a contact', function () {
    $this->fakeWafeq('/contacts/c_1/', ['id' => 'c_1', 'name' => 'Renamed', 'type' => 'CUSTOMER']);

    $c = LaravelWafeq::contacts()->update('c_1', ['name' => 'Renamed']);

    expect($c->name)->toBe('Renamed');
});

it('partial updates a contact', function () {
    $this->fakeWafeq('/contacts/c_1/', ['id' => 'c_1', 'name' => 'Acme', 'phone' => '+966500000000']);

    $c = LaravelWafeq::contacts()->partialUpdate('c_1', ['phone' => '+966500000000']);

    expect($c->phone)->toBe('+966500000000');
});

it('destroys a contact', function () {
    $this->fakeWafeq('/contacts/c_1/', '', 204);

    expect(LaravelWafeq::contacts()->destroy('c_1'))->toBeTrue();
});

it('throws NotFoundException on missing contact', function () {
    $this->fakeNotFound('/contacts/c_missing/');

    LaravelWafeq::contacts()->retrieve('c_missing');
})->throws(NotFoundException::class);

it('throws a generic WafeqException on 418', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/contacts/*' => Http::response(['detail' => 'I am a teapot'], 418),
    ]);

    LaravelWafeq::contacts()->list();
})->throws(WafeqException::class);
