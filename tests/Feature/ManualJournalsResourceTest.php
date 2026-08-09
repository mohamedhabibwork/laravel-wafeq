<?php

use HWafeq\LaravelWafeq\Data\ManualJournalData;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalCreated;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalDestroyed;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalListed;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalPartiallyUpdated;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalRetrieved;
use HWafeq\LaravelWafeq\Events\ManualJournals\ManualJournalUpdated;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists manual journals', function () {
    Event::fake([ManualJournalListed::class]);
    $this->fakeWafeqPage('/manual-journals/', [
        ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'narration' => 'Adjustment', 'currency' => 'SAR', 'totalDebit' => '1000.00', 'totalCredit' => '1000.00'],
    ]);

    $page = LaravelWafeq::manualJournals()->list();

    expect($page->results[0])->toBeInstanceOf(ManualJournalData::class)
        ->and($page->results[0]->totalDebit)->toBe('1000.00');

    Event::assertDispatched(ManualJournalListed::class);
});

it('creates a manual journal', function () {
    Event::fake([ManualJournalCreated::class]);
    $this->fakeWafeq('/manual-journals/', ['id' => 'mj_new', 'reference' => 'MJ-002', 'date' => '2024-01-15', 'currency' => 'SAR', 'totalDebit' => '500.00', 'totalCredit' => '500.00']);

    $mj = LaravelWafeq::manualJournals()->create([
        'date' => '2024-01-15',
        'currency' => 'SAR',
        'line_items' => [],
    ]);

    expect($mj->id)->toBe('mj_new');

    Event::assertDispatched(ManualJournalCreated::class);
});

it('retrieves a manual journal', function () {
    Event::fake([ManualJournalRetrieved::class]);
    $this->fakeWafeq('/manual-journals/mj_1/', ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'currency' => 'SAR']);

    $mj = LaravelWafeq::manualJournals()->retrieve('mj_1');

    expect($mj->id)->toBe('mj_1');

    Event::assertDispatched(ManualJournalRetrieved::class);
});

it('updates a manual journal', function () {
    Event::fake([ManualJournalUpdated::class]);
    $this->fakeWafeq('/manual-journals/mj_1/', ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'currency' => 'SAR', 'narration' => 'Updated']);

    $mj = LaravelWafeq::manualJournals()->update('mj_1', ['narration' => 'Updated']);

    expect($mj->narration)->toBe('Updated');

    Event::assertDispatched(ManualJournalUpdated::class);
});

it('partial updates a manual journal', function () {
    Event::fake([ManualJournalPartiallyUpdated::class]);
    $this->fakeWafeq('/manual-journals/mj_1/', ['id' => 'mj_1', 'reference' => 'MJ-001', 'date' => '2024-01-15', 'currency' => 'SAR', 'narration' => 'Patched']);

    $mj = LaravelWafeq::manualJournals()->partialUpdate('mj_1', ['narration' => 'Patched']);

    expect($mj->narration)->toBe('Patched');

    Event::assertDispatched(ManualJournalPartiallyUpdated::class);
});

it('destroys a manual journal', function () {
    Event::fake([ManualJournalDestroyed::class]);
    $this->fakeWafeq('/manual-journals/mj_1/', '', 204);

    expect(LaravelWafeq::manualJournals()->destroy('mj_1'))->toBeTrue();

    Event::assertDispatched(ManualJournalDestroyed::class);
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/manual-journals/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::manualJournals()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(ManualJournalData::class)
        ->and($result->id)->toBe('m_1');
});
