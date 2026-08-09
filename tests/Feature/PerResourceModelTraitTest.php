<?php

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Data\BillData;
use HWafeq\LaravelWafeq\Data\ContactData;
use HWafeq\LaravelWafeq\Data\InvoiceData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;

uses(FakesWafeq::class);

/**
 * Spot-check that the per-resource traits (e.g. InteractsWithContactsModel,
 * InteractsWithInvoicesModel, …) wire up correctly. We exercise one
 * resource from each major group rather than all 39 — every other trait
 * follows the same shape, and the live per-resource CRUD tests cover
 * the rest of the surface.
 */
it('InteractsWithContactsModel resolves id and returns a ContactData', function () {
    $model = new class extends Model
    {
        protected $attributes = ['wafeq_id' => 'c_x', 'name' => 'Acme', 'type' => 'CUSTOMER'];

        public function getKey()
        {
            return 'c_x';
        }
    };

    $this->fakeWafeq('/contacts/c_x/', [
        'id' => 'c_x', 'name' => 'Acme', 'type' => 'CUSTOMER',
    ]);

    $contact = LaravelWafeq::contacts()->withModel($model)->retrieveModel();

    expect($contact)->toBeInstanceOf(ContactData::class)
        ->and($contact->id)->toBe('c_x');
});

it('InteractsWithInvoicesModel returns an InvoiceData', function () {
    $model = new class extends Model
    {
        protected $attributes = ['wafeq_id' => 'inv_x', 'amount' => '100.00'];

        public function getKey()
        {
            return 'inv_x';
        }
    };

    $this->fakeWafeq('/invoices/inv_x/', [
        'id' => 'inv_x', 'currency' => 'SAR',
    ]);

    $invoice = LaravelWafeq::invoices()->withModel($model)->retrieveModel();

    expect($invoice)->toBeInstanceOf(InvoiceData::class)
        ->and($invoice->id)->toBe('inv_x');
});

it('InteractsWithAccountsModel returns an AccountData', function () {
    $model = new class extends Model
    {
        protected $attributes = ['wafeq_id' => 'acc_x', 'name' => 'Cash'];

        public function getKey()
        {
            return 'acc_x';
        }
    };

    $this->fakeWafeq('/accounts/acc_x/', [
        'id' => 'acc_x', 'name' => 'Cash', 'code' => '1000',
    ]);

    $account = LaravelWafeq::accounts()->withModel($model)->retrieveModel();

    expect($account)->toBeInstanceOf(AccountData::class)
        ->and($account->id)->toBe('acc_x');
});

it('InteractsWithBillsModel returns a BillData', function () {
    $model = new class extends Model
    {
        protected $attributes = ['wafeq_id' => 'bill_x', 'amount' => '250.00'];

        public function getKey()
        {
            return 'bill_x';
        }
    };

    $this->fakeWafeq('/bills/bill_x/', [
        'id' => 'bill_x', 'currency' => 'SAR',
    ]);

    $bill = LaravelWafeq::bills()->withModel($model)->retrieveModel();

    expect($bill)->toBeInstanceOf(BillData::class)
        ->and($bill->id)->toBe('bill_x');
});

it('every per-resource trait returns a concrete DTO, not a generic Data', function () {
    // Iterate over a handful of resource/DTO pairs to assert the typed
    // return shape. We don't hit HTTP here — we just verify the methods
    // resolve to the right concrete class when faked.
    $pairs = [
        ['accounts',   'acc_p',  AccountData::class],
        ['contacts',   'c_p',    ContactData::class],
        ['invoices',   'inv_p',  InvoiceData::class],
        ['bills',      'bill_p', BillData::class],
    ];

    foreach ($pairs as [$resource, $id, $dtoClass]) {
        $path = "/{$resource}/{$id}/";
        $body = ['id' => $id];

        $this->fakeWafeq($path, $body);

        $model = new class($id) extends Model
        {
            public function __construct(protected string $wafeqIdValue)
            {
                $this->attributes = ['wafeq_id' => $wafeqIdValue];
            }

            public function getKey()
            {
                return $this->wafeqIdValue;
            }
        };

        $resourceInstance = LaravelWafeq::{$resource}();

        expect($resourceInstance->withModel($model)->retrieveModel())->toBeInstanceOf($dtoClass);
    }
});
