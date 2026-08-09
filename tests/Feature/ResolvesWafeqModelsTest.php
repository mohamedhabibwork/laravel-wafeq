<?php

use HWafeq\LaravelWafeq\Concerns\HoldsWafeqModel;
use HWafeq\LaravelWafeq\Concerns\ResolvesWafeqModels;
use Illuminate\Database\Eloquent\Model;

function resolveSubject(): object
{
    return new class
    {
        use HoldsWafeqModel;
        use ResolvesWafeqModels;

        public function publicResolveWafeqId(): string
        {
            return $this->resolveWafeqId();
        }

        /**
         * @param  array<string, mixed>  $extra
         * @return array<string, mixed>
         */
        public function publicPayloadFromModel(array $extra = []): array
        {
            return $this->payloadFromModel($extra);
        }
    };
}

function makeModel(array $attributes = [], ?string $key = 'm_1'): Model
{
    return new class($attributes, $key) extends Model
    {
        protected $attributes;

        public function __construct(array $attributes, protected ?string $keyValue)
        {
            $this->attributes = $attributes;
        }

        public function getKey()
        {
            return $this->keyValue;
        }
    };
}

it('throws when no model has been bound', function () {
    resolveSubject()->publicResolveWafeqId();
})->throws(LogicException::class, 'No model has been bound');

it('resolves the id from getKey when no override is defined', function () {
    $model = makeModel(['name' => 'Acme']);

    $subject = resolveSubject()->withModel($model);

    expect($subject->publicResolveWafeqId())->toBe('m_1');
});

it('prefers a wafeqId() method over getKey()', function () {
    $model = new class extends Model
    {
        protected $attributes = ['id' => 'local_pk'];

        public function getKey()
        {
            return 'local_pk';
        }

        public function wafeqId(): string
        {
            return 'wafeq_pk';
        }
    };

    $subject = resolveSubject()->withModel($model);

    expect($subject->publicResolveWafeqId())->toBe('wafeq_pk');
});

it('falls back to the wafeq_id attribute when present', function () {
    $model = makeModel(['wafeq_id' => 'attr_pk', 'name' => 'Acme']);

    $subject = resolveSubject()->withModel($model);

    expect($subject->publicResolveWafeqId())->toBe('attr_pk');
});

it('throws when no id source yields a non-empty string', function () {
    $model = new class extends Model
    {
        protected $attributes = [];

        public function getKey(): ?string
        {
            return null;
        }
    };

    resolveSubject()->withModel($model)->publicResolveWafeqId();
})->throws(InvalidArgumentException::class);

it('builds a payload from the bound model attributes, stripping the id key', function () {
    $model = makeModel([
        'id' => 'm_1',
        'name' => 'Acme',
        'type' => 'CUSTOMER',
        'email' => 'x@x.test',
    ]);

    $payload = resolveSubject()->withModel($model)->publicPayloadFromModel();

    expect($payload)
        ->toHaveKey('name', 'Acme')
        ->toHaveKey('type', 'CUSTOMER')
        ->toHaveKey('email', 'x@x.test')
        ->not->toHaveKey('id');
});

it('merges extra keys into the payload and lets extras win', function () {
    $model = makeModel(['name' => 'Acme', 'type' => 'CUSTOMER']);

    $payload = resolveSubject()->withModel($model)->publicPayloadFromModel(['type' => 'VENDOR', 'currency' => 'SAR']);

    expect($payload)->toHaveKey('name', 'Acme')
        ->and($payload)->toHaveKey('type', 'VENDOR')
        ->and($payload)->toHaveKey('currency', 'SAR');
});

it('uses toWafeqPayload() when the model defines it, ignoring raw attributes', function () {
    $model = new class extends Model
    {
        protected $attributes = ['id' => 'm_1', 'name' => 'Raw', 'sensitive' => 'secret'];

        public function getKey()
        {
            return 'm_1';
        }

        /**
         * @return array<string, mixed>
         */
        public function toWafeqPayload(): array
        {
            return ['name' => 'Custom', 'type' => 'CUSTOMER'];
        }
    };

    $payload = resolveSubject()->withModel($model)->publicPayloadFromModel();

    expect($payload)->toBe(['name' => 'Custom', 'type' => 'CUSTOMER']);
});

it('wafeqId() mirrors resolveWafeqId()', function () {
    $model = makeModel(['name' => 'Acme'], 'm_42');

    $subject = resolveSubject()->withModel($model);

    expect($subject->wafeqId())->toBe('m_42');
});
