<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\ApiInvoices;

use HWafeq\LaravelWafeq\Data\ApiInvoiceData;
use HWafeq\LaravelWafeq\Enums\DiscountType;
use HWafeq\LaravelWafeq\Enums\LanguageAc1;
use HWafeq\LaravelWafeq\Enums\Medium;
use HWafeq\LaravelWafeq\Enums\TaxAmountType8ab;
use HWafeq\LaravelWafeq\Requests\WafeqFormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;

/**
 * FormRequest for `POST /api-invoices/bulk-send/` — Send invoices in bulk.
 *
 * Validation rules are derived from the OpenAPI schema in
 * `wafeq-docs/api_invoices_bulk_send_create.md`.
 *
 * The endpoint's request body shape (`BulkSendAPIInvoice`):
 *
 *   - `channels`              required array   — delivery channels
 *   - `contact`               required object  — recipient contact
 *   - `currency`              required enum    — ISO currency code
 *   - `invoice_date`          required date    — issue date (yyyy-mm-dd)
 *   - `invoice_number`        required string  — unique invoice number
 *   - `language`              required enum    — ar | en
 *   - `line_items`            required array   — invoice line items
 *   - `notes`                 string           — free-form notes
 *   - `paid_through_account`  string           — payment source account
 *   - `reference`             string           — internal reference
 *   - `tax_amount_type`       required enum    — TAX_INCLUSIVE | TAX_EXCLUSIVE
 *
 * Nested `Channel.data` (Email) requires `message`, `recipients`
 * (with at least `to`), and `subject`. Nested `contact` requires
 * `name`. Nested `line_items` items require `name`, `description`,
 * `price`, `quantity`.
 */
class CreateApiInvoiceBulkSendRequest extends WafeqFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            // Delivery channels (at most 1).
            'channels' => ['required', 'array', 'max:1'],
            'channels.*' => ['array'],
            'channels.*.data' => ['required_with:channels', 'array'],
            'channels.*.data.message' => ['required_with:channels.*.data', 'string'],
            'channels.*.data.subject' => ['required_with:channels.*.data', 'string'],
            'channels.*.data.recipients' => ['required_with:channels.*.data', 'array'],
            'channels.*.data.recipients.to' => ['required_with:channels.*.data.recipients', 'array'],
            'channels.*.data.recipients.to.*' => ['string', 'email'],
            'channels.*.data.recipients.cc' => ['sometimes', 'array'],
            'channels.*.data.recipients.cc.*' => ['string', 'email'],
            'channels.*.data.recipients.bcc' => ['sometimes', 'array'],
            'channels.*.data.recipients.bcc.*' => ['string', 'email'],
            'channels.*.medium' => ['required_with:channels', 'string', Rule::enum(Medium::class)],

            // Recipient contact block.
            'contact' => ['required', 'array'],
            'contact.name' => ['required', 'string'],
            'contact.email' => ['nullable', 'string', 'email'],
            'contact.address' => ['nullable', 'string'],
            'contact.city' => ['nullable', 'string'],
            'contact.country' => ['nullable', 'string'],
            'contact.tax_registration_number' => ['nullable', 'string'],

            // ISO-4217 currency code.
            'currency' => ['required', 'string'],

            // Issue date.
            'invoice_date' => ['required', 'date_format:Y-m-d'],

            // Caller-provided invoice number.
            'invoice_number' => ['required', 'string'],

            // Language code (ar | en).
            'language' => ['required', 'string', Rule::enum(LanguageAc1::class)],

            // Line items.
            'line_items' => ['required', 'array', 'min:1', 'max:100'],
            'line_items.*' => ['array'],
            'line_items.*.name' => ['required_with:line_items', 'string'],
            'line_items.*.description' => ['required_with:line_items', 'string'],
            'line_items.*.price' => ['required_with:line_items', 'numeric'],
            'line_items.*.quantity' => ['required_with:line_items', 'numeric'],
            'line_items.*.account' => ['nullable', 'string'],
            'line_items.*.discount' => ['nullable', 'array'],
            'line_items.*.discount.type' => ['required_with:line_items.*.discount', 'string', Rule::enum(DiscountType::class)],
            'line_items.*.discount.value' => ['required_with:line_items.*.discount', 'numeric'],
            'line_items.*.tax_rate' => ['nullable', 'array'],
            'line_items.*.tax_rate.name' => ['required_with:line_items.*.tax_rate', 'string'],
            'line_items.*.tax_rate.rate' => ['required_with:line_items.*.tax_rate', 'numeric'],
            'line_items.*.tax_rate.suid' => ['nullable', 'string'],

            // Free-form notes.
            'notes' => ['nullable', 'string'],

            // Payment source account.
            'paid_through_account' => ['nullable', 'string'],

            // Internal reference.
            'reference' => ['nullable', 'string'],

            // Tax amount type (required enum).
            'tax_amount_type' => ['required', 'string', Rule::enum(TaxAmountType8ab::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'channels' => 'channels',
            'channels.*.data.message' => 'channel message',
            'channels.*.data.subject' => 'channel subject',
            'channels.*.data.recipients' => 'channel recipients',
            'channels.*.data.recipients.to' => 'recipients to',
            'channels.*.data.recipients.cc' => 'recipients cc',
            'channels.*.data.recipients.bcc' => 'recipients bcc',
            'channels.*.medium' => 'channel medium',
            'contact' => 'contact',
            'contact.name' => 'contact name',
            'contact.email' => 'contact email',
            'currency' => 'currency',
            'invoice_date' => 'invoice date',
            'invoice_number' => 'invoice number',
            'language' => 'language',
            'line_items' => 'line items',
            'line_items.*.name' => 'line item name',
            'line_items.*.description' => 'line item description',
            'line_items.*.price' => 'line item price',
            'line_items.*.quantity' => 'line item quantity',
            'notes' => 'notes',
            'paid_through_account' => 'paid through account',
            'reference' => 'reference',
            'tax_amount_type' => 'tax amount type',
        ];
    }

    /**
     * @return class-string<Data>
     */
    public function dto(): string
    {
        return ApiInvoiceData::class;
    }
}
