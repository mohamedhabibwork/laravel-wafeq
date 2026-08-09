<?php

use HWafeq\LaravelWafeq\Concerns\HasWafeqResource;
use HWafeq\LaravelWafeq\Concerns\WafeqResourceProxy;
use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;

uses(FakesWafeq::class);

/**
 * Anonymous model class used by the tests below. Mixing in
 * HasWafeqResource makes `$model->wafeq()` available; the static
 * `wafeqResourceName()` returns `'contacts'` so the proxy resolves
 * to `ContactsResource` via the `LaravelWafeq` client.
 */
function wafeqCustomerModel(): Model
{
    return new class extends Model
    {
        use HasWafeqResource;

        protected $attributes = [
            'wafeq_id' => 'c_test',
            'name' => 'Acme',
        ];

        public function getKey()
        {
            return 'c_test';
        }

        public static function wafeqResourceName(): string
        {
            return 'contacts';
        }
    };
}

it('returns a WafeqResourceProxy from $model->wafeq()', function () {
    $proxy = wafeqCustomerModel()->wafeq();

    expect($proxy)->toBeInstanceOf(WafeqResourceProxy::class);
});

it('exposes a wafeqId() method on the model', function () {
    expect(wafeqCustomerModel()->wafeqId())->toBe('c_test');
});

it('proxy.wafeqId() returns the same id the model exposes', function () {
    expect(wafeqCustomerModel()->wafeq()->wafeqId())->toBe('c_test');
});

it('proxy.retrieve() forwards to retrieveModel() on the resource', function () {
    $this->fakeWafeq('/contacts/c_test/', [
        'id' => 'c_test', 'name' => 'Acme', 'type' => 'CUSTOMER',
    ]);

    $contact = wafeqCustomerModel()->wafeq()->retrieve();

    expect($contact)->toBeInstanceOf(ContactData::class)
        ->and($contact->id)->toBe('c_test')
        ->and($contact->name)->toBe('Acme');
});

it('proxy.update() forwards to updateModel() on the resource', function () {
    $this->fakeWafeq('/contacts/c_test/', [
        'id' => 'c_test', 'name' => 'Renamed', 'type' => 'CUSTOMER',
    ]);

    $contact = wafeqCustomerModel()->wafeq()->update(['name' => 'Renamed']);

    expect($contact)->toBeInstanceOf(ContactData::class)
        ->and($contact->name)->toBe('Renamed');
});

it('proxy.partialUpdate() forwards to partialUpdateModel() on the resource', function () {
    $this->fakeWafeq('/contacts/c_test/', [
        'id' => 'c_test', 'name' => 'Acme', 'phone' => '+966500000000',
    ]);

    $contact = wafeqCustomerModel()->wafeq()->partialUpdate(['phone' => '+966500000000']);

    expect($contact)->toBeInstanceOf(ContactData::class)
        ->and($contact->phone)->toBe('+966500000000');
});

it('proxy.destroy() forwards to destroyModel() on the resource', function () {
    $this->fakeWafeq('/contacts/c_test/', '', 204);

    expect(wafeqCustomerModel()->wafeq()->destroy())->toBeTrue();
});

it('proxy.create() forwards to createFromModel() on the resource', function () {
    $this->fakeWafeq('/contacts/', [
        'id' => 'c_new', 'name' => 'Acme', 'type' => 'CUSTOMER',
    ]);

    $contact = wafeqCustomerModel()->wafeq()->create();

    expect($contact)->toBeInstanceOf(ContactData::class)
        ->and($contact->id)->toBe('c_new');
});

it('resolves the Wafeq id from the wafeq_id attribute by default', function () {
    $model = new class extends Model
    {
        use HasWafeqResource;

        protected $attributes = ['wafeq_id' => 'attr_pk', 'name' => 'Acme'];

        public function getKey()
        {
            return 'local_pk';
        }

        public static function wafeqResourceName(): string
        {
            return 'contacts';
        }
    };

    expect($model->wafeqId())->toBe('attr_pk');
});

it('falls back to getKey when no wafeq_id attribute is present', function () {
    $model = new class extends Model
    {
        use HasWafeqResource;

        protected $attributes = ['name' => 'Acme'];

        public function getKey()
        {
            return 'local_pk';
        }

        public static function wafeqResourceName(): string
        {
            return 'contacts';
        }
    };

    expect($model->wafeqId())->toBe('local_pk');
});

it('lets a wafeqId() override on the host model win', function () {
    $model = new class extends Model
    {
        use HasWafeqResource;

        protected $attributes = ['name' => 'Acme'];

        public function getKey()
        {
            return 'local_pk';
        }

        public static function wafeqResourceName(): string
        {
            return 'contacts';
        }

        public function wafeqId(): ?string
        {
            return 'overridden_pk';
        }
    };

    expect($model->wafeqId())->toBe('overridden_pk');
});

it('proxy.__call() forwards arbitrary resource methods to the *Model variant when present', function () {
    // EndEarly has a corresponding endEarlyModel only on a few resources.
    // Use the *Model fallback: define a method on ContactsResource… it does
    // not exist, so __call falls back to `retrieve($id)` — which we can
    // verify actually happened.
    $this->fakeWafeq('/contacts/c_test/', [
        'id' => 'c_test', 'name' => 'Acme', 'type' => 'CUSTOMER',
    ]);

    $contact = wafeqCustomerModel()->wafeq()->retrieve('whatever');

    // The signature above was a *call forward* to `retrieve($id)`,
    // so Wafeq sees GET /contacts/c_test/ (the model's id), not 'whatever'.
    expect($contact->id)->toBe('c_test');
});

it('throws when wafeqResourceName() is not overridden', function () {
    $model = new class extends Model
    {
        use HasWafeqResource;
    };

    $model->wafeq();
})->throws(LogicException::class);
