<?php

use HWafeq\LaravelWafeq\Data\AccountData;
use HWafeq\LaravelWafeq\Data\PaginatedData;
use HWafeq\LaravelWafeq\Events\Accounts\AccountCreated;
use HWafeq\LaravelWafeq\Events\Accounts\AccountDestroyed;
use HWafeq\LaravelWafeq\Events\Accounts\AccountListed;
use HWafeq\LaravelWafeq\Events\Accounts\AccountPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\Accounts\AccountRetrieved;
use HWafeq\LaravelWafeq\Events\Accounts\AccountUpdated;
use HWafeq\LaravelWafeq\Exceptions\AuthenticationException;
use HWafeq\LaravelWafeq\Exceptions\NotFoundException;
use HWafeq\LaravelWafeq\Exceptions\ValidationException;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists accounts as paginated data', function () {
    Event::fake([AccountListed::class]);
    $this->fakeWafeqPage('/accounts/', [
        ['id' => 'acc_1', 'name' => 'Cash', 'code' => '1000', 'isSystem' => true, 'isPaymentEnabled' => true, 'currency' => 'SAR'],
        ['id' => 'acc_2', 'name' => 'Bank', 'code' => '1100', 'isSystem' => false, 'isPaymentEnabled' => true, 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::accounts()->list();

    expect($page)->toBeInstanceOf(PaginatedData::class)
        ->and($page->count)->toBe(2)
        ->and($page->results)->toHaveCount(2)
        ->and($page->results[0])->toBeInstanceOf(AccountData::class)
        ->and($page->results[0]->name)->toBe('Cash')
        ->and($page->results[0]->isSystem)->toBeTrue()
        ->and($page->results[1]->code)->toBe('1100');

    Event::assertDispatched(AccountListed::class);
});

it('forwards filter query parameters when listing', function () {
    Event::fake([AccountListed::class]);
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/accounts/*' => Http::response([
            'count' => 0, 'next' => null, 'previous' => null, 'results' => [],
        ]),
    ]);

    LaravelWafeq::accounts()->list(['is_system' => 'false', 'is_payment_enabled' => 'true']);

    Http::assertSent(function ($request) {
        return $request->method() === 'GET'
            && str_contains($request->url(), '/accounts/')
            && $request->data() === ['is_system' => 'false', 'is_payment_enabled' => 'true'];
    });

    Event::assertDispatched(AccountListed::class);
});

it('creates an account', function () {
    Event::fake([AccountCreated::class]);
    $this->fakeWafeq('/accounts/', ['id' => 'acc_new', 'name' => 'Petty Cash', 'code' => '1050', 'currency' => 'SAR'], 201);

    $account = LaravelWafeq::accounts()->create([
        'name' => 'Petty Cash',
        'code' => '1050',
        'currency' => 'SAR',
    ]);

    expect($account)->toBeInstanceOf(AccountData::class)
        ->and($account->id)->toBe('acc_new')
        ->and($account->name)->toBe('Petty Cash');

    Event::assertDispatched(AccountCreated::class);
});

it('creates an account with the idempotency header', function () {
    Event::fake([AccountCreated::class]);
    $this->fakeWafeq('/accounts/', ['id' => 'acc_new', 'name' => 'Petty Cash', 'code' => '1050']);

    LaravelWafeq::accounts()->create(['name' => 'Petty Cash', 'code' => '1050']);

    Http::assertSent(fn ($request) => $request->method() === 'POST'
        && $request->hasHeader('X-Wafeq-Idempotency-Key')
        && str_starts_with($request->header('X-Wafeq-Idempotency-Key')[0], ''));

    Event::assertDispatched(AccountCreated::class);
});

it('retrieves an account', function () {
    Event::fake([AccountRetrieved::class]);
    $this->fakeWafeq('/accounts/acc_1/', ['id' => 'acc_1', 'name' => 'Cash', 'code' => '1000', 'isSystem' => true]);

    $account = LaravelWafeq::accounts()->retrieve('acc_1');

    expect($account->id)->toBe('acc_1')
        ->and($account->name)->toBe('Cash')
        ->and($account->isSystem)->toBeTrue();

    Event::assertDispatched(AccountRetrieved::class);
});

it('updates an account', function () {
    Event::fake([AccountUpdated::class]);
    $this->fakeWafeq('/accounts/acc_1/', ['id' => 'acc_1', 'name' => 'Cash Updated', 'code' => '1000']);

    $account = LaravelWafeq::accounts()->update('acc_1', ['name' => 'Cash Updated', 'code' => '1000']);

    expect($account->name)->toBe('Cash Updated');

    Event::assertDispatched(AccountUpdated::class);
});

it('partial updates an account', function () {
    Event::fake([AccountPartiallyUpdated::class]);
    $this->fakeWafeq('/accounts/acc_1/', ['id' => 'acc_1', 'name' => 'Cash Patched', 'code' => '1000']);

    $account = LaravelWafeq::accounts()->partialUpdate('acc_1', ['name' => 'Cash Patched']);

    expect($account->name)->toBe('Cash Patched');

    Event::assertDispatched(AccountPartiallyUpdated::class);
});

it('destroys an account', function () {
    Event::fake([AccountDestroyed::class]);
    $this->fakeWafeq('/accounts/acc_1/', '', 204);

    expect(LaravelWafeq::accounts()->destroy('acc_1'))->toBeTrue();

    Event::assertDispatched(AccountDestroyed::class);
});

it('throws AuthenticationException on 401', function () {
    $this->fakeAuthError('/accounts/');

    LaravelWafeq::accounts()->list();
})->throws(AuthenticationException::class);

it('throws NotFoundException on 404', function () {
    $this->fakeNotFound('/accounts/acc_missing/');

    LaravelWafeq::accounts()->retrieve('acc_missing');
})->throws(NotFoundException::class);

it('throws ValidationException on 422 with errors', function () {
    $this->fakeValidationError('/accounts/', ['name' => ['This field is required.']]);

    try {
        LaravelWafeq::accounts()->create(['name' => '']);
    } catch (ValidationException $e) {
        expect($e->errors())->toBe(['name' => ['This field is required.']])
            ->and($e->statusCode)->toBe(422);

        return;
    }

    test()->fail('Expected ValidationException');
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/accounts/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::accounts()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(AccountData::class)
        ->and($result->id)->toBe('m_1');
});
