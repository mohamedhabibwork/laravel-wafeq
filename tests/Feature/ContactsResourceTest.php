<?php

use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Events\Contacts\ContactCreated;
use HWafeq\LaravelWafeq\Events\Contacts\ContactDestroyed;
use HWafeq\LaravelWafeq\Events\Contacts\ContactListed;
use HWafeq\LaravelWafeq\Events\Contacts\ContactPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Contacts\ContactRetrieved;
use HWafeq\LaravelWafeq\Events\Contacts\ContactUpdated;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\WafeqException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists contacts', function () {
    Event::fake([ContactListed::class]);
    $this->fakeWafeqPage('/contacts/', [
        ['id' => 'c_1', 'name' => 'Acme Co.', 'type' => 'CUSTOMER', 'email' => 'billing@acme.test', 'currency' => 'SAR', 'country' => 'SA'],
        ['id' => 'c_2', 'name' => 'Vendor X', 'type' => 'VENDOR', 'email' => 'info@vendorx.test', 'currency' => 'SAR', 'country' => 'SA'],
    ]);

    $page = LaravelWafeq::contacts()->list();

    expect($page->count)->toBe(2)
        ->and($page->results[0])->toBeInstanceOf(ContactData::class)
        ->and($page->results[0]->type)->toBe('CUSTOMER')
        ->and($page->results[1]->type)->toBe('VENDOR');

    Event::assertDispatched(ContactListed::class);
});

it('creates a contact', function () {
    Event::fake([ContactCreated::class]);
    $this->fakeWafeq('/contacts/', ['id' => 'c_new', 'name' => 'New Contact', 'type' => 'CUSTOMER', 'email' => 'x@x.test', 'currency' => 'SAR']);

    $c = LaravelWafeq::contacts()->create(['name' => 'New Contact', 'type' => 'CUSTOMER']);

    expect($c->id)->toBe('c_new');

    Event::assertDispatched(ContactCreated::class);
});

it('retrieves a contact', function () {
    Event::fake([ContactRetrieved::class]);
    $this->fakeWafeq('/contacts/c_1/', ['id' => 'c_1', 'name' => 'Acme Co.', 'type' => 'CUSTOMER', 'email' => 'billing@acme.test']);

    $c = LaravelWafeq::contacts()->retrieve('c_1');

    expect($c->email)->toBe('billing@acme.test');

    Event::assertDispatched(ContactRetrieved::class);
});

it('updates a contact', function () {
    Event::fake([ContactUpdated::class]);
    $this->fakeWafeq('/contacts/c_1/', ['id' => 'c_1', 'name' => 'Renamed', 'type' => 'CUSTOMER']);

    $c = LaravelWafeq::contacts()->update('c_1', ['name' => 'Renamed']);

    expect($c->name)->toBe('Renamed');

    Event::assertDispatched(ContactUpdated::class);
});

it('partial updates a contact', function () {
    Event::fake([ContactPartiallyUpdated::class]);
    $this->fakeWafeq('/contacts/c_1/', ['id' => 'c_1', 'name' => 'Acme', 'phone' => '+966500000000']);

    $c = LaravelWafeq::contacts()->partialUpdate('c_1', ['phone' => '+966500000000']);

    expect($c->phone)->toBe('+966500000000');

    Event::assertDispatched(ContactPartiallyUpdated::class);
});

it('destroys a contact', function () {
    Event::fake([ContactDestroyed::class]);
    $this->fakeWafeq('/contacts/c_1/', '', 204);

    expect(LaravelWafeq::contacts()->destroy('c_1'))->toBeTrue();

    Event::assertDispatched(ContactDestroyed::class);
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

it('exposes model-aware overloads that resolve id and build payload from an Eloquent model', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/contacts/c_model/' => Http::response(['id' => 'c_model', 'name' => 'Acme', 'type' => 'CUSTOMER'], 200),
        'https://api-sandbox.wafeq.com/v1/contacts/' => Http::response(['id' => 'c_new', 'name' => 'Acme', 'type' => 'CUSTOMER'], 200),
    ]);

    $contact = new class extends Model
    {
        protected $attributes = [
            'id' => 'c_model',
            'name' => 'Acme',
            'type' => 'CUSTOMER',
            'email' => 'x@x.test',
        ];

        public function getKey()
        {
            return 'c_model';
        }
    };

    $resource = LaravelWafeq::contacts()->withModel($contact);

    expect($resource->wafeqId())->toBe('c_model');

    $retrieved = $resource->retrieveModel();
    expect($retrieved)->toBeInstanceOf(ContactData::class)
        ->and($retrieved->id)->toBe('c_model');

    $created = $resource->createFromModel();
    expect($created->id)->toBe('c_new');
});
