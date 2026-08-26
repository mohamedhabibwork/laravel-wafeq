<?php

/**
 * Contract for the Wafeq Client.
 *
 * Defines one factory method per Wafeq resource group.
 *
 * @method \HWafeq\LaravelWafeq\Contracts\OrganizationResourceContract organization()
 * @method \HWafeq\LaravelWafeq\Contracts\AccountsResourceContract accounts()
 * @method \HWafeq\LaravelWafeq\Contracts\AmortizationsResourceContract amortizations()
 * @method \HWafeq\LaravelWafeq\Contracts\ApiCreditNotesResourceContract apiCreditNotes()
 * @method \HWafeq\LaravelWafeq\Contracts\ApiInvoicesResourceContract apiInvoices()
 * @method \HWafeq\LaravelWafeq\Contracts\BankAccountsResourceContract bankAccounts()
 * @method \HWafeq\LaravelWafeq\Contracts\BankLedgerTransactionsResourceContract bankLedgerTransactions()
 * @method \HWafeq\LaravelWafeq\Contracts\BankStatementTransactionsResourceContract bankStatementTransactions()
 * @method \HWafeq\LaravelWafeq\Contracts\BeneficiariesResourceContract beneficiaries()
 * @method \HWafeq\LaravelWafeq\Contracts\BillsResourceContract bills()
 * @method \HWafeq\LaravelWafeq\Contracts\BillsLineItemsResourceContract billsLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\BranchesResourceContract branches()
 * @method \HWafeq\LaravelWafeq\Contracts\ContactsResourceContract contacts()
 * @method \HWafeq\LaravelWafeq\Contracts\CostCentersResourceContract costCenters()
 * @method \HWafeq\LaravelWafeq\Contracts\CreditNotesResourceContract creditNotes()
 * @method \HWafeq\LaravelWafeq\Contracts\CreditNotesLineItemsResourceContract creditNotesLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\CustomFieldsResourceContract customFields()
 * @method \HWafeq\LaravelWafeq\Contracts\DebitNotesResourceContract debitNotes()
 * @method \HWafeq\LaravelWafeq\Contracts\DebitNotesLineItemsResourceContract debitNotesLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\EmployeesResourceContract employees()
 * @method \HWafeq\LaravelWafeq\Contracts\ExpensesResourceContract expenses()
 * @method \HWafeq\LaravelWafeq\Contracts\FilesResourceContract files()
 * @method \HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract invoices()
 * @method \HWafeq\LaravelWafeq\Contracts\InvoicesLineItemsResourceContract invoicesLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\ItemUnitsOfMeasureResourceContract itemUnitsOfMeasure()
 * @method \HWafeq\LaravelWafeq\Contracts\ItemsResourceContract items()
 * @method \HWafeq\LaravelWafeq\Contracts\JournalLineItemsResourceContract journalLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\ManualJournalsResourceContract manualJournals()
 * @method \HWafeq\LaravelWafeq\Contracts\PaymentRequestsResourceContract paymentRequests()
 * @method \HWafeq\LaravelWafeq\Contracts\PaymentsResourceContract payments()
 * @method \HWafeq\LaravelWafeq\Contracts\PayslipsResourceContract payslips()
 * @method \HWafeq\LaravelWafeq\Contracts\PayslipsPayItemsResourceContract payslipsPayItems()
 * @method \HWafeq\LaravelWafeq\Contracts\ProjectsResourceContract projects()
 * @method \HWafeq\LaravelWafeq\Contracts\PurchaseOrdersResourceContract purchaseOrders()
 * @method \HWafeq\LaravelWafeq\Contracts\PurchaseOrdersLineItemsResourceContract purchaseOrdersLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\QuotesResourceContract quotes()
 * @method \HWafeq\LaravelWafeq\Contracts\QuotesLineItemsResourceContract quotesLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\ReportsResourceContract reports()
 * @method \HWafeq\LaravelWafeq\Contracts\RevenueRecognitionsResourceContract revenueRecognitions()
 * @method \HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesResourceContract simplifiedInvoices()
 * @method \HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesLineItemsResourceContract simplifiedInvoicesLineItems()
 * @method \HWafeq\LaravelWafeq\Contracts\TaxRatesResourceContract taxRates()
 * @method \HWafeq\LaravelWafeq\Contracts\UnitsOfMeasureResourceContract unitsOfMeasure()
 * @method \HWafeq\LaravelWafeq\Contracts\WarehousesResourceContract warehouses()
 */

namespace HWafeq\LaravelWafeq\Contracts;

use HWafeq\LaravelWafeq\Connector;
use HWafeq\LaravelWafeq\Enums\Currency;

/**
 * ClientContract Contract.
 *
 * @see LaravelWafeq
 */
interface ClientContract
{
    public function connector(): Connector;

    /**
     * Resolve the configured default currency for this Wafeq organisation.
     *
     * Reads `currency` from the package config first. When the configured
     * value is `null` (or a non-existent ISO-4217 case), the package will
     * fetch the organisation's `financial_settings.base_currency` via
     * `GET /organization/` and cache it for the lifetime of the client.
     *
     * Returns `null` only when neither source yields a currency.
     */
    public function defaultCurrency(): ?Currency;

    public function organization(): OrganizationResourceContract;

    public function accounts(): AccountsResourceContract;

    public function amortizations(): AmortizationsResourceContract;

    public function apiCreditNotes(): ApiCreditNotesResourceContract;

    public function apiInvoices(): ApiInvoicesResourceContract;

    public function bankAccounts(): BankAccountsResourceContract;

    public function bankLedgerTransactions(): BankLedgerTransactionsResourceContract;

    public function bankStatementTransactions(): BankStatementTransactionsResourceContract;

    public function beneficiaries(): BeneficiariesResourceContract;

    public function bills(): BillsResourceContract;

    public function billsLineItems(): BillsLineItemsResourceContract;

    public function branches(): BranchesResourceContract;

    public function contacts(): ContactsResourceContract;

    public function costCenters(): CostCentersResourceContract;

    public function creditNotes(): CreditNotesResourceContract;

    public function creditNotesLineItems(): CreditNotesLineItemsResourceContract;

    public function customFields(): CustomFieldsResourceContract;

    public function debitNotes(): DebitNotesResourceContract;

    public function debitNotesLineItems(): DebitNotesLineItemsResourceContract;

    public function employees(): EmployeesResourceContract;

    public function expenses(): ExpensesResourceContract;

    public function files(): FilesResourceContract;

    public function invoices(): InvoicesResourceContract;

    public function invoicesLineItems(): InvoicesLineItemsResourceContract;

    public function itemUnitsOfMeasure(): ItemUnitsOfMeasureResourceContract;

    public function items(): ItemsResourceContract;

    public function journalLineItems(): JournalLineItemsResourceContract;

    public function manualJournals(): ManualJournalsResourceContract;

    public function paymentRequests(): PaymentRequestsResourceContract;

    public function payments(): PaymentsResourceContract;

    public function payslips(): PayslipsResourceContract;

    public function payslipsPayItems(): PayslipsPayItemsResourceContract;

    public function projects(): ProjectsResourceContract;

    public function purchaseOrders(): PurchaseOrdersResourceContract;

    public function purchaseOrdersLineItems(): PurchaseOrdersLineItemsResourceContract;

    public function quotes(): QuotesResourceContract;

    public function quotesLineItems(): QuotesLineItemsResourceContract;

    public function reports(): ReportsResourceContract;

    public function revenueRecognitions(): RevenueRecognitionsResourceContract;

    public function simplifiedInvoices(): SimplifiedInvoicesResourceContract;

    public function simplifiedInvoicesLineItems(): SimplifiedInvoicesLineItemsResourceContract;

    public function taxRates(): TaxRatesResourceContract;

    public function unitsOfMeasure(): UnitsOfMeasureResourceContract;

    public function warehouses(): WarehousesResourceContract;
}
