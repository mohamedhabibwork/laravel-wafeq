<?php

use HWafeq\LaravelWafeq\Data\DebitNoteData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Support\Facades\Http;

uses(FakesWafeq::class);

it('lists debit notes', function () {
    $this->fakeWafeqPage('/debit-notes/', [
        ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'OPEN', 'total' => '250.00', 'currency' => 'SAR', 'issueDate' => '2024-01-15'],
    ]);

    $page = LaravelWafeq::debitNotes()->list();

    expect($page->results[0])->toBeInstanceOf(DebitNoteData::class)
        ->and($page->results[0]->status)->toBe('OPEN');
});

it('creates a debit note', function () {
    $this->fakeWafeq('/debit-notes/', ['id' => 'dn_new', 'debitNoteNumber' => 'DN-002', 'status' => 'DRAFT', 'total' => '500.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->create(['contact' => 'c_1', 'currency' => 'SAR', 'line_items' => []]);

    expect($dn->id)->toBe('dn_new');
});

it('retrieves a debit note', function () {
    $this->fakeWafeq('/debit-notes/dn_1/', ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'OPEN', 'total' => '250.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->retrieve('dn_1');

    expect($dn->id)->toBe('dn_1');
});

it('updates a debit note', function () {
    $this->fakeWafeq('/debit-notes/dn_1/', ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'PAID', 'total' => '250.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->update('dn_1', ['status' => 'PAID']);

    expect($dn->status)->toBe('PAID');
});

it('partial updates a debit note', function () {
    $this->fakeWafeq('/debit-notes/dn_1/', ['id' => 'dn_1', 'debitNoteNumber' => 'DN-001', 'status' => 'PAID', 'total' => '250.00', 'currency' => 'SAR']);

    $dn = LaravelWafeq::debitNotes()->partialUpdate('dn_1', ['status' => 'PAID']);

    expect($dn->status)->toBe('PAID');
});

it('destroys a debit note', function () {
    $this->fakeWafeq('/debit-notes/dn_1/', '', 204);

    expect(LaravelWafeq::debitNotes()->destroy('dn_1'))->toBeTrue();
});

it('downloads a debit note', function () {
    Http::fake([
        'https://api-sandbox.wafeq.com/v1/debit-notes/dn_1/download/*' => Http::response('PDF', 200, ['Content-Type' => 'application/pdf']),
    ]);

    $response = LaravelWafeq::debitNotes()->download('dn_1');

    expect($response->body())->toBe('PDF');
});
