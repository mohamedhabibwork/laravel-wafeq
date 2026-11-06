<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaLanguage;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

/**
 * A complete report / validate / issue request body: the document plus
 * its optional delivery keys, in the API's flat wire shape. This is what
 * the ZATCA document FormRequests produce, and what the bulk endpoints
 * take one of per document.
 */
class ZatcaReportRequestData extends ZatcaPayloadData
{
    /**
     * @param  array<int, ZatcaChannelData>  $channels
     * @param  array<string, string|null>|null  $metadata
     * @param  array<string, mixed>|null  $template
     */
    public function __construct(
        public ZatcaDocumentPayloadData $document,
        #[DataCollectionOf(ZatcaChannelData::class)]
        public array $channels = [],
        #[WithCast(EnumCast::class)]
        public ?ZatcaLanguage $language = null,
        public ?array $metadata = null,
        public ?string $reference = null,
        public ?array $template = null,
    ) {}

    public static function for(ZatcaDocumentPayloadData $document, ?ZatcaDeliveryOptionsData $options = null): self
    {
        return new self(
            document: $document,
            channels: $options->channels ?? [],
            language: $options?->language,
            metadata: $options?->metadata,
            reference: $options?->reference,
            template: $options?->template,
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        $payload = parent::toPayload();
        $payload['document'] = $this->document->toPayload();

        return $payload;
    }
}
