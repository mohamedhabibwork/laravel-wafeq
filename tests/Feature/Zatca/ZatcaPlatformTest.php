<?php

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaConnectedAccountData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDeviceData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDeviceStatus;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaWalletBalance;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaConnectedAccountCreated;
use HWafeq\LaravelWafeq\Events\Zatca\ZatcaDeviceRegistered;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Http;

/**
 * @return array<string, string>
 */
function zatcaConnectedAccount(): array
{
    return [
        'id' => 'ca_1',
        'name' => 'ABCD Inc',
        'address' => 'Anas Bin Malik, Al Malqa',
        'city' => 'Riyadh',
        'country' => 'SA',
        'business_category' => 'Manufacturing',
        'tax_registration_number' => '311111111111113',
    ];
}

/**
 * @return array<string, mixed>
 */
function zatcaDevice(string $status = 'active'): array
{
    return ['id' => 'zdev_1', 'common_name' => 'Device 1', 'status' => $status, 'branch' => '', 'connected_account' => 'ca_1'];
}

it('runs the platform flow: connected account, device, then report on its behalf', function () {
    Event::fake([ZatcaConnectedAccountCreated::class, ZatcaDeviceRegistered::class]);
    Http::fake([
        ZATCA_URL.'/connected-accounts/' => Http::response(zatcaConnectedAccount(), 201),
        ZATCA_URL.'/devices/register/' => Http::response(zatcaDevice()),
        ZATCA_URL.'/invoices/report/' => Http::response(['status' => 'REPORTED', 'document' => ['id' => 'zdoc_1', 'document_number' => 'INV-1']], 201),
    ]);

    $zatca = LaravelWafeq::zatca()->production();

    $account = $zatca->connectedAccounts()->create(array_diff_key(zatcaConnectedAccount(), ['id' => true]));
    $customer = $zatca->forConnectedAccount($account->id);
    $device = $customer->devices()->register('Device 1', '111111');
    $document = $customer->invoices()->report(['currency' => 'SAR']);

    expect($account)->toBeInstanceOf(ZatcaConnectedAccountData::class)
        ->and($account->taxRegistrationNumber)->toBe('311111111111113')
        ->and($account->businessCategory)->toBe('Manufacturing')
        ->and($device)->toBeInstanceOf(ZatcaDeviceData::class)
        ->and($device->isActive())->toBeTrue()
        ->and($device->connectedAccount)->toBe('ca_1')
        ->and($document->isReported())->toBeTrue();

    Http::assertSent(fn (Request $request) => str_ends_with($request->url(), '/devices/register/')
        && $request->hasHeader('X-ZATCA-Connected-Account-Id', 'ca_1')
        && $request->hasHeader('X-ZATCA-Environment', 'production')
        && $request->data() === ['common_name' => 'Device 1', 'otp' => '111111']);
    Http::assertSent(fn (Request $request) => str_ends_with($request->url(), '/invoices/report/')
        && $request->hasHeader('X-ZATCA-Connected-Account-Id', 'ca_1'));
    Http::assertSent(fn (Request $request) => str_ends_with($request->url(), '/connected-accounts/')
        && ! $request->hasHeader('X-ZATCA-Connected-Account-Id'));

    Event::assertDispatched(ZatcaConnectedAccountCreated::class, fn ($event) => $event->id === 'ca_1');
    Event::assertDispatched(ZatcaDeviceRegistered::class, fn ($event) => ! array_key_exists('otp', $event->payload));
});

it('lists, retrieves, updates and deletes connected accounts', function () {
    Http::fake([
        ZATCA_URL.'/connected-accounts/?page=2' => Http::response(['count' => 11, 'next' => null, 'previous' => 'p1', 'results' => [zatcaConnectedAccount()]]),
        ZATCA_URL.'/connected-accounts/ca_1/' => function (Request $request) {
            return $request->method() === 'DELETE'
                ? Http::response(null, 204)
                : Http::response([...zatcaConnectedAccount(), 'city' => $request['city'] ?? 'Riyadh']);
        },
    ]);

    $accounts = LaravelWafeq::zatca()->connectedAccounts();

    expect($accounts->list(['page' => 2])->results[0]->id)->toBe('ca_1')
        ->and($accounts->retrieve('ca_1')->name)->toBe('ABCD Inc')
        ->and($accounts->update('ca_1', [...zatcaConnectedAccount(), 'city' => 'Jeddah'])->city)->toBe('Jeddah')
        ->and($accounts->partialUpdate('ca_1', ['city' => 'Dammam'])->city)->toBe('Dammam')
        ->and($accounts->destroy('ca_1'))->toBeTrue();
});

it('registers a device for a Group VAT member using the branch header', function () {
    Http::fake([ZATCA_URL.'/devices/register/' => Http::response(zatcaDevice())]);

    LaravelWafeq::zatca()->forBranch('3125678939')->devices()->register('abdallah-jeddah', '123456');

    Http::assertSent(fn (Request $request) => $request->hasHeader('X-ZATCA-Branch', '3125678939'));
});

it('lists, retrieves, renews and revokes devices', function () {
    Http::fake([
        ZATCA_URL.'/devices/?keyword=POS' => Http::response(['count' => 1, 'next' => null, 'previous' => null, 'results' => [zatcaDevice()]]),
        ZATCA_URL.'/devices/zdev_1/renew/' => Http::response(zatcaDevice()),
        ZATCA_URL.'/devices/zdev_1/revoke/' => Http::response(zatcaDevice('revoked')),
        ZATCA_URL.'/devices/zdev_1/' => Http::response(zatcaDevice('pending')),
    ]);

    $devices = LaravelWafeq::zatca()->devices();

    expect($devices->list(['keyword' => 'POS'])->results[0]->status)->toBe(ZatcaDeviceStatus::Active)
        ->and($devices->retrieve('zdev_1')->status)->toBe(ZatcaDeviceStatus::Pending)
        ->and($devices->renew('zdev_1', '222222')->isActive())->toBeTrue()
        ->and($devices->revoke('zdev_1')->status)->toBe(ZatcaDeviceStatus::Revoked);

    Http::assertSent(fn (Request $request) => str_ends_with($request->url(), '/renew/') && $request->data() === ['otp' => '222222']);
});

it('reports remaining ZATCA document credits', function () {
    Http::fake([ZATCA_URL.'/usage/' => Http::response([
        'available' => 0,
        'balance' => 'OUT',
        'debt' => 2,
        'enforced' => true,
        'exempt' => false,
        'simulation' => false,
        'term_allowance' => 1000,
        'term_consumed' => 1000,
        'term_ends_ts' => '2027-01-01T00:00:00Z',
    ])]);

    $usage = LaravelWafeq::zatca()->usage()->retrieve();

    expect($usage->balance)->toBe(ZatcaWalletBalance::Out)
        ->and($usage->termAllowance)->toBe(1000)
        ->and($usage->debt)->toBe(2)
        ->and($usage->isBlocked())->toBeTrue();
});
