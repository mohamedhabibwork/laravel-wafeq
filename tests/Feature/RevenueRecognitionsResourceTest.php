<?php

use HWafeq\LaravelWafeq\Data\RevenueRecognitionData;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionDestroyed;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionListed;
use HWafeq\LaravelWafeq\Events\RevenueRecognitions\RevenueRecognitionRetrieved;
use HWafeq\LaravelWafeq\Facades\LaravelWafeq;
use HWafeq\LaravelWafeq\Tests\Pests\Concerns\FakesWafeq;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Event;

uses(FakesWafeq::class);

it('lists revenue recognitions', function () {
    Event::fake([RevenueRecognitionListed::class]);
    $this->fakeWafeqPage('/revenue-recognitions/', [
        ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'ACTIVE', 'totalAmount' => '12000.00', 'recognizedAmount' => '3000.00', 'currency' => 'SAR', 'startDate' => '2024-01-01', 'endDate' => '2024-12-31'],
    ]);

    $page = LaravelWafeq::revenueRecognitions()->list();

    expect($page->results[0])->toBeInstanceOf(RevenueRecognitionData::class)
        ->and($page->results[0]->status)->toBe('ACTIVE');

    Event::assertDispatched(RevenueRecognitionListed::class);
});

it('retrieves a revenue recognition', function () {
    Event::fake([RevenueRecognitionRetrieved::class]);
    $this->fakeWafeq('/revenue-recognitions/rr_1/', ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'ACTIVE', 'totalAmount' => '12000.00', 'currency' => 'SAR']);

    $rr = LaravelWafeq::revenueRecognitions()->retrieve('rr_1');

    expect($rr->id)->toBe('rr_1');

    Event::assertDispatched(RevenueRecognitionRetrieved::class);
});

it('destroys a revenue recognition', function () {
    Event::fake([RevenueRecognitionDestroyed::class]);
    $this->fakeWafeq('/revenue-recognitions/rr_1/', '', 204);

    expect(LaravelWafeq::revenueRecognitions()->destroy('rr_1'))->toBeTrue();

    Event::assertDispatched(RevenueRecognitionDestroyed::class);
});

it('previews a revenue recognition before creating', function () {
    $this->fakeWafeq('/revenue-recognitions/preview/', ['id' => 'preview_1', 'name' => 'Preview', 'totalAmount' => '12000.00', 'currency' => 'SAR']);

    $preview = LaravelWafeq::revenueRecognitions()->previewCreate([
        'name' => 'Annual License',
        'total' => '12000.00',
        'currency' => 'SAR',
    ]);

    expect($preview->id)->toBe('preview_1');
});

it('ends a revenue recognition early', function () {
    $this->fakeWafeq('/revenue-recognitions/rr_1/end_early/', ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'ENDED_EARLY']);

    $rr = LaravelWafeq::revenueRecognitions()->endEarly('rr_1', ['effective_date' => '2024-06-30']);

    expect($rr->status)->toBe('ENDED_EARLY');
});

it('previews ending a revenue recognition early', function () {
    $this->fakeWafeq('/revenue-recognitions/rr_1/preview_end_early/', ['id' => 'rr_1', 'name' => 'Annual License', 'status' => 'PREVIEW_ENDED']);

    $preview = LaravelWafeq::revenueRecognitions()->previewEndEarly('rr_1', ['effective_date' => '2024-06-30']);

    expect($preview->status)->toBe('PREVIEW_ENDED');
});

it('retrieves from a model via the InteractsWithModels trait', function () {
    $this->fakeWafeq('/revenue-recognitions/m_1/', ['id' => 'm_1']);

    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1'];

        public function getKey(): string
        {
            return 'm_1';
        }
    };

    $result = LaravelWafeq::revenueRecognitions()->withModel($model)->retrieveModel();

    expect($result)->toBeInstanceOf(RevenueRecognitionData::class)
        ->and($result->id)->toBe('m_1');
});
