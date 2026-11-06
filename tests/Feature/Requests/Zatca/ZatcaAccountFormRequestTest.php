<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaConnectedAccountPayloadData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeliveryOptionsData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaDeviceRegistrationData;
use HWafeq\LaravelWafeq\Data\Zatca\Payload\ZatcaMetadataUpdateData;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\CreateZatcaConnectedAccountRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\PartialUpdateZatcaConnectedAccountRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\RegisterZatcaDeviceRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\RenewZatcaDeviceRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\SendZatcaDocumentRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\UpdateZatcaConnectedAccountRequest;
use HWafeq\LaravelWafeq\Requests\Zatca\UpdateZatcaDocumentMetadataRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

/**
 * @template T of WafeqFormRequest
 *
 * @param  class-string<T>  $class
 * @param  array<string, mixed>  $payload
 * @return T
 */
function zatcaResolvedRequest(string $class, array $payload, $app): WafeqFormRequest
{
    $request = $class::create('/zatca', 'POST', $payload);
    $request->setContainer($app);
    $request->setRedirector($app->make(Redirector::class));
    $request->validateResolved();

    return $request;
}

/**
 * @return array<string, string>
 */
function zatcaAccountPayload(): array
{
    return [
        'name' => 'ABCD Inc',
        'address' => 'Anas Bin Malik, Al Malqa',
        'city' => 'Riyadh',
        'country' => 'SA',
        'business_category' => 'Manufacturing',
        'tax_registration_number' => '311111111111113',
    ];
}

it('requires every connected-account field on create and update', function (string $class) {
    $errors = Validator::make([], (new $class)->rules())->errors();

    expect($errors->keys())->toEqualCanonicalizing(['name', 'address', 'city', 'business_category', 'tax_registration_number']);
})->with([
    'create' => [CreateZatcaConnectedAccountRequest::class],
    'update' => [UpdateZatcaConnectedAccountRequest::class],
]);

it('makes every connected-account field optional on partial update', function () {
    $rules = (new PartialUpdateZatcaConnectedAccountRequest)->rules();

    expect(Validator::make([], $rules)->passes())->toBeTrue()
        ->and(Validator::make(['tax_registration_number' => '123'], $rules)->errors()->keys())->toBe(['tax_registration_number']);
});

it('materialises a connected-account payload', function () {
    $dto = zatcaResolvedRequest(CreateZatcaConnectedAccountRequest::class, zatcaAccountPayload(), $this->app)->toDto();

    expect($dto)->toBeInstanceOf(ZatcaConnectedAccountPayloadData::class)
        ->and($dto->businessCategory)->toBe('Manufacturing')
        ->and($dto->toPayload())->toBe(zatcaAccountPayload());
});

it('validates device registration and renewal', function () {
    expect(Validator::make(['common_name' => str_repeat('x', 65)], (new RegisterZatcaDeviceRequest)->rules())->errors()->keys())
        ->toEqualCanonicalizing(['common_name', 'otp'])
        ->and(Validator::make([], (new RenewZatcaDeviceRequest)->rules())->errors()->keys())->toBe(['otp']);

    $dto = zatcaResolvedRequest(RegisterZatcaDeviceRequest::class, ['common_name' => 'POS 1', 'otp' => '123456'], $this->app)->toDto();

    expect($dto)->toBeInstanceOf(ZatcaDeviceRegistrationData::class)
        ->and($dto->commonName)->toBe('POS 1')
        ->and($dto->otp)->toBe('123456');
});

it('requires a channel to send a document', function () {
    expect(Validator::make([], (new SendZatcaDocumentRequest)->rules())->errors()->keys())->toBe(['channels']);

    $dto = zatcaResolvedRequest(SendZatcaDocumentRequest::class, [
        'channels' => [['medium' => 'email', 'data' => ['recipients' => ['to' => ['c@example.com']], 'subject' => 'S', 'message' => 'M']]],
    ], $this->app)->toDto();

    expect($dto)->toBeInstanceOf(ZatcaDeliveryOptionsData::class)
        ->and($dto->channels)->toHaveCount(1);
});

it('accepts null values to remove metadata keys', function () {
    $dto = zatcaResolvedRequest(UpdateZatcaDocumentMetadataRequest::class, ['metadata' => ['order' => '42', 'legacy' => null]], $this->app)->toDto();

    expect($dto)->toBeInstanceOf(ZatcaMetadataUpdateData::class)
        ->and($dto->metadata)->toBe(['order' => '42', 'legacy' => null])
        ->and(Validator::make(['metadata' => ['x' => ['nested']]], (new UpdateZatcaDocumentMetadataRequest)->rules())->fails())->toBeTrue();
});
