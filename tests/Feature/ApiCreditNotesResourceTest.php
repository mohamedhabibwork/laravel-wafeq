<?php

use HWafeq\LaravelWafeq\Data\ApiCreditNoteData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists api credit notes', function () {
    $this->fakeWafeqPage('/api-credit-notes/', [
        ['id' => 'acn_1', 'reference' => 'CN-001', 'status' => 'SENT', 'total' => '500.00', 'currency' => 'SAR'],
    ]);

    $page = LaravelWafeq::apiCreditNotes()->list();

    expect($page->results[0])->toBeInstanceOf(ApiCreditNoteData::class)
        ->and($page->results[0]->reference)->toBe('CN-001');
});

it('retrieves an api credit note', function () {
    $this->fakeWafeq('/api-credit-notes/acn_1/', ['id' => 'acn_1', 'reference' => 'CN-001', 'status' => 'SENT', 'total' => '500.00', 'currency' => 'SAR']);

    $cn = LaravelWafeq::apiCreditNotes()->retrieve('acn_1');

    expect($cn->id)->toBe('acn_1');
});

it('destroys an api credit note', function () {
    $this->fakeWafeq('/api-credit-notes/acn_1/', '', 204);

    expect(LaravelWafeq::apiCreditNotes()->destroy('acn_1'))->toBeTrue();
});

it('downloads an api credit note', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/api-credit-notes/acn_1/download/*' => Http::response('PDF_BINARY', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::apiCreditNotes()->download('acn_1');

    expect($response->body())->toBe('PDF_BINARY');
});

it('bulk sends api credit notes', function () {
    $this->fakeWafeq('/api-credit-notes/bulk_send/', ['queued' => 1]);

    $result = LaravelWafeq::apiCreditNotes()->bulkSend([['reference' => 'CN-001']]);

    expect($result)->toBe(['queued' => 1]);
});
