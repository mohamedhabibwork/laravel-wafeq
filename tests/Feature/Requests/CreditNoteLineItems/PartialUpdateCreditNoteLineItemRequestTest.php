<?php

declare(strict_types=1);

use HWafeq\LaravelWafeq\Data\CreditNoteLineItemData;
use HWafeq\LaravelWafeq\Requests\CreditNoteLineItems\PartialUpdateCreditNoteLineItemRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

it('validates a partial-update payload that only sets one field', function () {
    $payload = ['description' => 'Updated description only'];

    $request = PartialUpdateCreditNoteLineItemRequest::create('/credit-notes/cn_1/line-items/li_1/', 'PATCH', $payload);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    expect($request->rules())->toBeArray()
        ->and($request->authorize())->toBeTrue()
        ->and($request->dto())->toBe(CreditNoteLineItemData::class);

    $validator = Validator::make($payload, $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('treats an empty partial-update payload as valid', function () {
    $request = PartialUpdateCreditNoteLineItemRequest::create('/credit-notes/cn_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make([], $request->rules());
    expect($validator->fails())->toBeFalse();
});

it('rejects a negative discount percentage on partial update', function () {
    $request = PartialUpdateCreditNoteLineItemRequest::create('/credit-notes/cn_1/line-items/li_1/', 'PATCH', []);
    $request->setContainer($this->app);
    $request->setRedirector($this->app->make(Redirector::class));

    $validator = Validator::make(
        ['discount' => '-1'],
        ['discount' => $request->rules()['discount']],
    );

    expect($validator->fails())->toBeTrue();
});
