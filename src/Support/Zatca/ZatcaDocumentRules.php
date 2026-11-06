<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Support\Zatca;

use HWafeq\LaravelWafeq\Enums\Currency;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaCustomerIdentificationType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentIndicator;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaExemptionReason;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaLanguage;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaSupplierIdentificationType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxAmountType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaTaxCategory;
use Illuminate\Validation\Rule;

/**
 * Laravel validation rules for ZATCA request bodies, derived from the
 * Wafeq ZATCA OpenAPI reference (`*_report_create`).
 *
 * The rules differ per {@see ZatcaDocumentType}:
 *  - standard (B2B) documents require a named customer with street and city;
 *  - credit / debit notes require `reference_document_number` and
 *    `payment_means` with `code` + `issue_reason`;
 *  - prepayment invoices may not carry `prepayments`.
 */
final class ZatcaDocumentRules
{
    private const MAX_SHORT = 127;

    private const MAX_TEXT = 1000;

    private const MAX_REFERENCE_DOCUMENT_NUMBER = 5000;

    private const MAX_PERCENT = 100;

    private const VAT_NUMBER_LENGTH = 15;

    private const MAX_CHANNELS = 1;

    private const MAX_RECIPIENTS = 6;

    /**
     * Rules for a complete report / validate / issue body.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function reportRequest(ZatcaDocumentType $type): array
    {
        return [...self::document($type), ...self::deliveryOptions()];
    }

    /**
     * Rules for the `document` object.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function document(ZatcaDocumentType $type, string $prefix = 'document'): array
    {
        $isNote = $type->isNote();

        return [
            $prefix => ['required', 'array'],
            "{$prefix}.document_number" => ['required', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.currency" => ['required', Rule::enum(Currency::class)],
            "{$prefix}.supply_date" => ['required', 'date_format:Y-m-d'],
            "{$prefix}.supply_end_date" => ['nullable', 'date_format:Y-m-d', "after_or_equal:{$prefix}.supply_date"],
            "{$prefix}.created_ts" => ['nullable', 'date'],
            "{$prefix}.tax_amount_type" => ['nullable', Rule::enum(ZatcaTaxAmountType::class)],
            "{$prefix}.tax_total" => ['nullable', 'numeric'],
            "{$prefix}.note" => ['nullable', 'string', 'max:'.self::MAX_TEXT],
            "{$prefix}.reference_contract_id" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.reference_purchase_order_id" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.indicators" => ['nullable', 'array'],
            "{$prefix}.indicators.*" => ['distinct', Rule::enum(ZatcaDocumentIndicator::class)],
            "{$prefix}.reference_document_number" => $isNote
                ? ['required', 'string', 'max:'.self::MAX_REFERENCE_DOCUMENT_NUMBER]
                : ['prohibited'],
            ...self::supplier("{$prefix}.supplier"),
            ...self::customer("{$prefix}.customer", ! $type->isSimplified()),
            ...self::lineItems("{$prefix}.line_items"),
            ...self::charges("{$prefix}.charges"),
            ...self::discounts("{$prefix}.discounts"),
            ...self::prepayments("{$prefix}.prepayments", $type->isPrepayment()),
            ...self::paymentMeans("{$prefix}.payment_means", $isNote),
        ];
    }

    /**
     * Rules for the optional keys sent next to a document, or on their own
     * to the `send` endpoint.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function deliveryOptions(): array
    {
        return [
            'channels' => ['nullable', 'array', 'max:'.self::MAX_CHANNELS],
            'channels.*.medium' => ['required', Rule::in(['email'])],
            'channels.*.data' => ['required', 'array'],
            'channels.*.data.subject' => ['required', 'string'],
            'channels.*.data.message' => ['required', 'string'],
            'channels.*.data.recipients' => ['required', 'array'],
            'channels.*.data.recipients.to' => ['required', 'array', 'min:1', 'max:'.self::MAX_RECIPIENTS],
            'channels.*.data.recipients.to.*' => ['required', 'email'],
            'channels.*.data.recipients.cc' => ['nullable', 'array', 'max:'.self::MAX_RECIPIENTS],
            'channels.*.data.recipients.cc.*' => ['email'],
            'channels.*.data.recipients.bcc' => ['nullable', 'array', 'max:'.self::MAX_RECIPIENTS],
            'channels.*.data.recipients.bcc.*' => ['email'],
            'language' => ['nullable', Rule::enum(ZatcaLanguage::class)],
            'metadata' => ['nullable', 'array'],
            'metadata.*' => ['nullable', 'string'],
            'reference' => ['nullable', 'string'],
            'template' => ['nullable', 'array'],
            'template.id' => ['nullable', 'string'],
            'template.config' => ['nullable', 'array'],
        ];
    }

    /**
     * Rules for a VAT object (`type`, `percent`, exemption reason).
     *
     * Every non-standard category needs an exemption reason; the
     * out-of-scope reason (`VATEX-SA-OOS`) also needs a free-text reason.
     *
     * @return array<string, array<int, mixed>>
     */
    public static function tax(string $prefix): array
    {
        return [
            $prefix => ['required', 'array'],
            "{$prefix}.type" => ['required', Rule::enum(ZatcaTaxCategory::class)],
            "{$prefix}.percent" => ['required', 'numeric', 'min:0', 'max:'.self::MAX_PERCENT],
            "{$prefix}.exemption_reason" => [
                'nullable',
                'required_unless:'."{$prefix}.type,".ZatcaTaxCategory::Standard->value,
                Rule::enum(ZatcaExemptionReason::class),
            ],
            "{$prefix}.exemption_reason_text" => [
                'nullable',
                'string',
                'max:'.self::MAX_TEXT,
                "required_if:{$prefix}.exemption_reason,".ZatcaExemptionReason::OutOfScope->value,
            ],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function supplier(string $prefix): array
    {
        return [
            $prefix => ['required', 'array'],
            "{$prefix}.name" => ['required', 'string', 'max:'.self::MAX_TEXT],
            "{$prefix}.address" => ['required', 'array'],
            "{$prefix}.address.street" => ['required', 'string', 'max:'.self::MAX_TEXT],
            "{$prefix}.address.building" => ['required', 'string'],
            "{$prefix}.address.city" => ['required', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.address.district" => ['required', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.address.postal_code" => ['required', 'string'],
            "{$prefix}.address.country" => ['required', Rule::in(ZatcaCodeLists::COUNTRY_CODES)],
            "{$prefix}.address.additional_street" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.address.province" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.identification" => ['required', 'array'],
            "{$prefix}.identification.type" => ['required', Rule::enum(ZatcaSupplierIdentificationType::class)],
            "{$prefix}.identification.value" => ['required', 'string'],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function customer(string $prefix, bool $isStandard): array
    {
        $requiredForStandard = $isStandard ? 'required' : 'nullable';

        return [
            // A simplified (B2C) customer may be an empty object: every field is optional.
            $prefix => [$isStandard ? 'required' : 'present', 'array'],
            "{$prefix}.name" => [$requiredForStandard, 'string', 'max:'.self::MAX_TEXT],
            "{$prefix}.tax_registration_number" => ['nullable', 'string', 'size:'.self::VAT_NUMBER_LENGTH],
            "{$prefix}.address" => [$requiredForStandard, 'array'],
            "{$prefix}.address.country" => ["required_with:{$prefix}.address", Rule::in(ZatcaCodeLists::COUNTRY_CODES)],
            "{$prefix}.address.street" => [$requiredForStandard, 'string', 'max:'.self::MAX_TEXT],
            "{$prefix}.address.city" => [$requiredForStandard, 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.address.building" => ['nullable', 'string'],
            "{$prefix}.address.district" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.address.postal_code" => ['nullable', 'string'],
            "{$prefix}.address.additional_street" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.address.province" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.identification" => ['nullable', 'array'],
            "{$prefix}.identification.type" => ["required_with:{$prefix}.identification", Rule::enum(ZatcaCustomerIdentificationType::class)],
            "{$prefix}.identification.value" => ["required_with:{$prefix}.identification", 'string'],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function lineItems(string $prefix): array
    {
        $line = "{$prefix}.*";

        return [
            $prefix => ['required', 'array', 'min:1'],
            "{$line}.item" => ['required', 'string', 'max:'.self::MAX_TEXT],
            "{$line}.description" => ['required', 'string'],
            "{$line}.quantity" => ['required', 'numeric'],
            "{$line}.unit_price" => ['required', 'numeric'],
            "{$line}.unit_of_measure" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$line}.identifiers" => ['nullable', 'array'],
            "{$line}.identifiers.customer_id" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$line}.identifiers.supplier_id" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$line}.identifiers.standard_id" => ['nullable', 'array'],
            "{$line}.identifiers.standard_id.scheme" => ["required_with:{$line}.identifiers.standard_id", 'string'],
            "{$line}.identifiers.standard_id.value" => ["required_with:{$line}.identifiers.standard_id", 'string', 'max:'.self::MAX_SHORT],
            ...self::tax("{$line}.tax"),
            ...self::charges("{$line}.charges"),
            ...self::discounts("{$line}.discounts"),
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function charges(string $prefix): array
    {
        return [
            ...self::allowance($prefix, ZatcaCodeLists::CHARGE_REASON_CODES),
            "{$prefix}.*.reason_text" => ['nullable', 'string', 'max:'.self::MAX_TEXT],
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function discounts(string $prefix): array
    {
        return self::allowance($prefix, ZatcaCodeLists::DISCOUNT_REASON_CODES);
    }

    /**
     * Shared shape of charges and discounts: an amount, or a percent of a base.
     *
     * @param  list<string>  $reasonCodes
     * @return array<string, array<int, mixed>>
     */
    private static function allowance(string $prefix, array $reasonCodes): array
    {
        $entry = "{$prefix}.*";

        return [
            $prefix => ['nullable', 'array'],
            "{$entry}.reason" => ['required', Rule::in($reasonCodes)],
            "{$entry}.amount" => ['nullable', 'numeric', "required_without:{$entry}.percent"],
            "{$entry}.percent" => ['nullable', 'numeric', 'min:0', 'max:'.self::MAX_PERCENT, "required_without:{$entry}.amount"],
            "{$entry}.base_amount" => ['nullable', 'numeric', "required_with:{$entry}.percent"],
            ...self::tax("{$entry}.tax"),
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function prepayments(string $prefix, bool $isPrepaymentInvoice): array
    {
        if ($isPrepaymentInvoice) {
            return [$prefix => ['prohibited']];
        }

        $entry = "{$prefix}.*";

        return [
            $prefix => ['nullable', 'array'],
            "{$entry}.reference" => ['required', 'string'],
            "{$entry}.issue_datetime" => ['required', 'date'],
            "{$entry}.amount" => ['required', 'numeric'],
            ...self::tax("{$entry}.tax"),
        ];
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    private static function paymentMeans(string $prefix, bool $isNote): array
    {
        $required = $isNote ? 'required' : 'nullable';

        return [
            $prefix => [$required, 'array'],
            "{$prefix}.code" => [$required, Rule::in(ZatcaCodeLists::PAYMENT_MEANS_CODES)],
            "{$prefix}.issue_reason" => $isNote ? ['required', 'string', 'max:'.self::MAX_TEXT] : ['prohibited'],
            "{$prefix}.account_id" => ['nullable', 'string', 'max:'.self::MAX_SHORT],
            "{$prefix}.payment_terms" => ['nullable', 'string', 'max:'.self::MAX_TEXT],
        ];
    }
}
