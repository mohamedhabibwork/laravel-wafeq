<?php

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;

uses(FakesWafeq::class);

it('lists manual journals', function () {
    $this->fakeWafeqPage('/manual-journals/', [
        ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'narration' => 'Adjustment', 'currency' => 'SAR', 'totalDebit' => '1000.00', 'totalCredit' => '1000.00'],
    ]);

    $page = LaravelWafeq::manualJournals()->list();

    expect($page->results[0])->toBeInstanceOf(ManualJournalData::class)
        ->and($page->results[0]->totalDebit)->toBe('1000.00');
});

it('creates a manual journal', function () {
    $this->fakeWafeq('/manual-journals/', ['id' => 'mj_new', 'reference' => 'MJ-002', 'date' => '2024-01-15', 'currency' => 'SAR', 'totalDebit' => '500.00', 'totalCredit' => '500.00']);

    $mj = LaravelWafeq::manualJournals()->create([
        'date' => '2024-01-15',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($mj->id)->toBe('mj_new');
});

it('retrieves a manual journal', function () {
    $this->fakeWafeq('/manual-journals/mj_1/', ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'currency' => 'SAR']);

    $mj = LaravelWafeq::manualJournals()->retrieve('mj_1');

    expect($mj->id)->toBe('mj_1');
});

it('updates a manual journal', function () {
    $this->fakeWafeq('/manual-journals/mj_1/', ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'currency' => 'SAR', 'narration' => 'Updated']);

    $mj = LaravelWafeq::manualJournals()->update('mj_1', ['narration' => 'Updated']);

    expect($mj->narration)->toBe('Updated');
});

it('partial updates a manual journal', function () {
    $this->fakeWafeq('/manual-journals/mj_1/', ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'currency' => 'SAR', 'narration' => 'Patched']);

    $mj = LaravelWafeq::manualJournals()->partialUpdate('mj_1', ['narration' => 'Patched']);

    expect($mj->narration)->toBe('Patched');
});

it('destroys a manual journal', function () {
    $this->fakeWafeq('/manual-journals/mj_1/', '', 204);

    expect(LaravelWafeq::manualJournals()->destroy('mj_1'))->toBeTrue();
});
