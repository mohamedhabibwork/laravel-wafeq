<?php

namespace HWafeq\LaravelWafeq\Contracts\Zatca;

use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaEnvironment;

/**
 * Entry point for the Wafeq ZATCA e-invoicing API.
 *
 * Instances are immutable: every `with*` / `for*` call returns a new,
 * re-scoped client, so a scoped instance can be stored and reused safely.
 *
 * ```php
 * $zatca = LaravelWafeq::zatca()->simulation();
 *
 * $zatca->devices()->register('POS 1', $otp);                    // onboard
 * $zatca->simplifiedInvoices()->report($document);                // B2C
 * $zatca->invoices()->report($document, ['channels' => $email]);  // B2B
 *
 * $zatca->forConnectedAccount($accountId)->invoices()->report($document); // platforms
 * ```
 */
interface ZatcaClientContract
{
    /**
     * The environment requests are sent to (`X-ZATCA-Environment`).
     */
    public function environment(): ZatcaEnvironment;

    /**
     * The branch / Group VAT member TIN requests are scoped to (`X-ZATCA-Branch`).
     */
    public function branch(): ?string;

    /**
     * The connected account requests are made on behalf of (`X-ZATCA-Connected-Account-Id`).
     */
    public function connectedAccount(): ?string;

    public function withEnvironment(ZatcaEnvironment|string $environment): static;

    public function simulation(): static;

    public function production(): static;

    /**
     * Scope to a branch, or to a Group VAT member by its TIN. `null` clears it.
     */
    public function forBranch(?string $branch): static;

    /**
     * Act on behalf of a platform's connected account. `null` clears it.
     */
    public function forConnectedAccount(?string $connectedAccountId): static;

    /**
     * The ZATCA headers every scoped request carries.
     *
     * @return array<string, string>
     */
    public function headers(): array;

    public function connectedAccounts(): ZatcaConnectedAccountsResourceContract;

    public function devices(): ZatcaDevicesResourceContract;

    public function usage(): ZatcaUsageResourceContract;

    public function documents(ZatcaDocumentType $type): ZatcaDocumentsResourceContract;

    public function invoices(): ZatcaDocumentsResourceContract;

    public function creditNotes(): ZatcaDocumentsResourceContract;

    public function debitNotes(): ZatcaDocumentsResourceContract;

    public function prepaymentInvoices(): ZatcaDocumentsResourceContract;

    public function simplifiedInvoices(): ZatcaSimplifiedDocumentsResourceContract;

    public function simplifiedCreditNotes(): ZatcaSimplifiedDocumentsResourceContract;

    public function simplifiedDebitNotes(): ZatcaSimplifiedDocumentsResourceContract;

    public function prepaymentSimplifiedInvoices(): ZatcaSimplifiedDocumentsResourceContract;
}
