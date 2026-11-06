<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentIndicator;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxAmountType;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

/**
 * The `document` body shared by every ZATCA document family.
 *
 * Family-specific requirements (validated by the ZATCA FormRequests):
 *  - credit / debit notes: `referenceDocumentNumber` and `paymentMeans`
 *    with `code` + `issueReason`;
 *  - standard (B2B) documents: a named customer with street and city;
 *  - prepayment invoices: no `prepayments`.
 *
 * `taxTotal` is the VAT total you calculated; Wafeq validates it against
 * the line items. `customer` defaults to an anonymous B2C buyer.
 */
class ZatcaDocumentPayloadData extends ZatcaPayloadData
{
    /**
     * @param  array<int, ZatcaLineItemData>  $lineItems
     * @param  array<int, ZatcaChargeData>  $charges
     * @param  array<int, ZatcaDiscountData>  $discounts
     * @param  array<int, ZatcaPrepaymentData>  $prepayments
     * @param  array<int, ZatcaDocumentIndicator|string>  $indicators
     */
    public function __construct(
        public string $documentNumber,
        #[WithCast(EnumCast::class)]
        public Currency $currency,
        public string $supplyDate,
        public ZatcaSupplierData $supplier,
        #[DataCollectionOf(ZatcaLineItemData::class)]
        public array $lineItems,
        public ZatcaCustomerData $customer = new ZatcaCustomerData,
        public ?float $taxTotal = null,
        #[WithCast(EnumCast::class)]
        public ?ZatcaTaxAmountType $taxAmountType = null,
        public ?string $supplyEndDate = null,
        public ?string $referenceDocumentNumber = null,
        public ?ZatcaPaymentMeansData $paymentMeans = null,
        #[DataCollectionOf(ZatcaChargeData::class)]
        public array $charges = [],
        #[DataCollectionOf(ZatcaDiscountData::class)]
        public array $discounts = [],
        #[DataCollectionOf(ZatcaPrepaymentData::class)]
        public array $prepayments = [],
        public array $indicators = [],
        public ?string $note = null,
        public ?string $referenceContractId = null,
        public ?string $referencePurchaseOrderId = null,
        public ?string $createdTs = null,
    ) {}

    /**
     * An anonymous (empty) customer is sent as a JSON object, not `[]`:
     * the API requires `customer` to be an object.
     *
     * @return array<string, mixed>
     */
    public function toPayload(): array
    {
        $payload = parent::toPayload();

        if (($payload['customer'] ?? null) === []) {
            $payload['customer'] = new \stdClass;
        }

        return $payload;
    }
}
