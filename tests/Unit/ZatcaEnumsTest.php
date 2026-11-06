<?php

use HWafeq\LaravelWafeq\Data\Zatca\ZatcaDeviceData;
use HWafeq\LaravelWafeq\Data\Zatca\ZatcaUsageData;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentStatus;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaEnvironment;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaWalletBalance;

it('infers the environment from ZATCA API key prefixes', function (string $key, ?ZatcaEnvironment $expected) {
    expect(ZatcaEnvironment::fromApiKey($key))->toBe($expected);
})->with([
    'live key' => ['zatca_live_abc', ZatcaEnvironment::Production],
    'simulation key' => ['zatca_sim_abc', ZatcaEnvironment::Simulation],
    'regular key' => ['vVLOU1BB.aKz8GW', null],
]);

it('builds collection paths for document types', function () {
    expect(ZatcaDocumentType::SimplifiedCreditNote->path())->toBe('/zatca/simplified-credit-notes/')
        ->and(ZatcaDocumentType::PrepaymentInvoice->path())->toBe('/zatca/prepayment-invoices/');
});

it('marks only the simplified families as simplified', function () {
    $simplified = array_values(array_filter(ZatcaDocumentType::cases(), fn (ZatcaDocumentType $type) => $type->isSimplified()));

    expect($simplified)->toBe([
        ZatcaDocumentType::SimplifiedInvoice,
        ZatcaDocumentType::SimplifiedCreditNote,
        ZatcaDocumentType::SimplifiedDebitNote,
        ZatcaDocumentType::PrepaymentSimplifiedInvoice,
    ]);
});

it('classifies document statuses', function () {
    expect(ZatcaDocumentStatus::Error->isUnsuccessful())->toBeTrue()
        ->and(ZatcaDocumentStatus::Failed->isUnsuccessful())->toBeTrue()
        ->and(ZatcaDocumentStatus::Reported->isUnsuccessful())->toBeFalse()
        ->and(ZatcaDocumentStatus::Processing->isInProgress())->toBeTrue()
        ->and(ZatcaDocumentStatus::Reported->isInProgress())->toBeFalse();
});

it('hydrates unknown enum wire values to null instead of failing', function () {
    $device = ZatcaDeviceData::from(['id' => 'zdev_1', 'status' => 'suspended']);
    $usage = ZatcaUsageData::from(['balance' => 'LOW']);

    expect($device->status)->toBeNull()
        ->and($device->isActive())->toBeFalse()
        ->and($usage->balance)->toBe(ZatcaWalletBalance::Low);
});
