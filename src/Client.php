<?php

/**
 * Concrete Client implementation that wires every Wafeq resource group
 * to a singleton connector. One factory method per resource is exposed
 * via the corresponding *ResourceContract interface.
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

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Contracts\AccountsResourceContract;
use HWafeq\LaravelWafeq\Contracts\AmortizationsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ApiCreditNotesResourceContract;
use HWafeq\LaravelWafeq\Contracts\ApiInvoicesResourceContract;
use HWafeq\LaravelWafeq\Contracts\BankAccountsResourceContract;
use HWafeq\LaravelWafeq\Contracts\BankLedgerTransactionsResourceContract;
use HWafeq\LaravelWafeq\Contracts\BankStatementTransactionsResourceContract;
use HWafeq\LaravelWafeq\Contracts\BeneficiariesResourceContract;
use HWafeq\LaravelWafeq\Contracts\BillsLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\BillsResourceContract;
use HWafeq\LaravelWafeq\Contracts\BranchesResourceContract;
use HWafeq\LaravelWafeq\Contracts\ClientContract;
use HWafeq\LaravelWafeq\Contracts\ContactsResourceContract;
use HWafeq\LaravelWafeq\Contracts\CostCentersResourceContract;
use HWafeq\LaravelWafeq\Contracts\CreditNotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\CreditNotesResourceContract;
use HWafeq\LaravelWafeq\Contracts\CustomFieldsResourceContract;
use HWafeq\LaravelWafeq\Contracts\DebitNotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\DebitNotesResourceContract;
use HWafeq\LaravelWafeq\Contracts\EmployeesResourceContract;
use HWafeq\LaravelWafeq\Contracts\ExpensesResourceContract;
use HWafeq\LaravelWafeq\Contracts\FilesResourceContract;
use HWafeq\LaravelWafeq\Contracts\InvoicesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\InvoicesResourceContract;
use HWafeq\LaravelWafeq\Contracts\ItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ItemUnitsOfMeasureResourceContract;
use HWafeq\LaravelWafeq\Contracts\JournalLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ManualJournalsResourceContract;
use HWafeq\LaravelWafeq\Contracts\OrganizationResourceContract;
use HWafeq\LaravelWafeq\Contracts\PaymentRequestsResourceContract;
use HWafeq\LaravelWafeq\Contracts\PaymentsResourceContract;
use HWafeq\LaravelWafeq\Contracts\PayslipsPayItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\PayslipsResourceContract;
use HWafeq\LaravelWafeq\Contracts\ProjectsResourceContract;
use HWafeq\LaravelWafeq\Contracts\PurchaseOrdersLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\PurchaseOrdersResourceContract;
use HWafeq\LaravelWafeq\Contracts\QuotesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\QuotesResourceContract;
use HWafeq\LaravelWafeq\Contracts\ReportsResourceContract;
use HWafeq\LaravelWafeq\Contracts\RevenueRecognitionsResourceContract;
use HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesLineItemsResourceContract;
use HWafeq\LaravelWafeq\Contracts\SimplifiedInvoicesResourceContract;
use HWafeq\LaravelWafeq\Contracts\TaxRatesResourceContract;
use HWafeq\LaravelWafeq\Contracts\UnitsOfMeasureResourceContract;
use HWafeq\LaravelWafeq\Contracts\WarehousesResourceContract;
use HWafeq\LaravelWafeq\Resources\AccountsResource;
use HWafeq\LaravelWafeq\Resources\AmortizationsResource;
use HWafeq\LaravelWafeq\Resources\ApiCreditNotesResource;
use HWafeq\LaravelWafeq\Resources\ApiInvoicesResource;
use HWafeq\LaravelWafeq\Resources\BankAccountsResource;
use HWafeq\LaravelWafeq\Resources\BankLedgerTransactionsResource;
use HWafeq\LaravelWafeq\Resources\BankStatementTransactionsResource;
use HWafeq\LaravelWafeq\Resources\BeneficiariesResource;
use HWafeq\LaravelWafeq\Resources\BillsLineItemsResource;
use HWafeq\LaravelWafeq\Resources\BillsResource;
use HWafeq\LaravelWafeq\Resources\BranchesResource;
use HWafeq\LaravelWafeq\Resources\ContactsResource;
use HWafeq\LaravelWafeq\Resources\CostCentersResource;
use HWafeq\LaravelWafeq\Resources\CreditNotesLineItemsResource;
use HWafeq\LaravelWafeq\Resources\CreditNotesResource;
use HWafeq\LaravelWafeq\Resources\CustomFieldsResource;
use HWafeq\LaravelWafeq\Resources\DebitNotesLineItemsResource;
use HWafeq\LaravelWafeq\Resources\DebitNotesResource;
use HWafeq\LaravelWafeq\Resources\EmployeesResource;
use HWafeq\LaravelWafeq\Resources\ExpensesResource;
use HWafeq\LaravelWafeq\Resources\FilesResource;
use HWafeq\LaravelWafeq\Resources\InvoicesLineItemsResource;
use HWafeq\LaravelWafeq\Resources\InvoicesResource;
use HWafeq\LaravelWafeq\Resources\ItemsResource;
use HWafeq\LaravelWafeq\Resources\ItemUnitsOfMeasureResource;
use HWafeq\LaravelWafeq\Resources\JournalLineItemsResource;
use HWafeq\LaravelWafeq\Resources\ManualJournalsResource;
use HWafeq\LaravelWafeq\Resources\OrganizationResource;
use HWafeq\LaravelWafeq\Resources\PaymentRequestsResource;
use HWafeq\LaravelWafeq\Resources\PaymentsResource;
use HWafeq\LaravelWafeq\Resources\PayslipsPayItemsResource;
use HWafeq\LaravelWafeq\Resources\PayslipsResource;
use HWafeq\LaravelWafeq\Resources\ProjectsResource;
use HWafeq\LaravelWafeq\Resources\PurchaseOrdersLineItemsResource;
use HWafeq\LaravelWafeq\Resources\PurchaseOrdersResource;
use HWafeq\LaravelWafeq\Resources\QuotesLineItemsResource;
use HWafeq\LaravelWafeq\Resources\QuotesResource;
use HWafeq\LaravelWafeq\Resources\ReportsResource;
use HWafeq\LaravelWafeq\Resources\RevenueRecognitionsResource;
use HWafeq\LaravelWafeq\Resources\SimplifiedInvoicesLineItemsResource;
use HWafeq\LaravelWafeq\Resources\SimplifiedInvoicesResource;
use HWafeq\LaravelWafeq\Resources\TaxRatesResource;
use HWafeq\LaravelWafeq\Resources\UnitsOfMeasureResource;
use HWafeq\LaravelWafeq\Resources\WarehousesResource;

/**
 * Client Class.
 *
 * @see LaravelWafeq
 */
class Client implements ClientContract
{
    public function __construct(private readonly Connector $connector) {}

    public function connector(): Connector
    {
        return $this->connector;
    }

    public function organization(): OrganizationResourceContract
    {
        return new OrganizationResource($this->connector->make());
    }

    public function accounts(): AccountsResourceContract
    {
        return new AccountsResource($this->connector->make());
    }

    public function amortizations(): AmortizationsResourceContract
    {
        return new AmortizationsResource($this->connector->make());
    }

    public function apiCreditNotes(): ApiCreditNotesResourceContract
    {
        return new ApiCreditNotesResource($this->connector->make());
    }

    public function apiInvoices(): ApiInvoicesResourceContract
    {
        return new ApiInvoicesResource($this->connector->make());
    }

    public function bankAccounts(): BankAccountsResourceContract
    {
        return new BankAccountsResource($this->connector->make());
    }

    public function bankLedgerTransactions(): BankLedgerTransactionsResourceContract
    {
        return new BankLedgerTransactionsResource($this->connector->make());
    }

    public function bankStatementTransactions(): BankStatementTransactionsResourceContract
    {
        return new BankStatementTransactionsResource($this->connector->make());
    }

    public function beneficiaries(): BeneficiariesResourceContract
    {
        return new BeneficiariesResource($this->connector->make());
    }

    public function bills(): BillsResourceContract
    {
        return new BillsResource($this->connector->make());
    }

    public function billsLineItems(): BillsLineItemsResourceContract
    {
        return new BillsLineItemsResource($this->connector->make());
    }

    public function branches(): BranchesResourceContract
    {
        return new BranchesResource($this->connector->make());
    }

    public function contacts(): ContactsResourceContract
    {
        return new ContactsResource($this->connector->make());
    }

    public function costCenters(): CostCentersResourceContract
    {
        return new CostCentersResource($this->connector->make());
    }

    public function creditNotes(): CreditNotesResourceContract
    {
        return new CreditNotesResource($this->connector->make());
    }

    public function creditNotesLineItems(): CreditNotesLineItemsResourceContract
    {
        return new CreditNotesLineItemsResource($this->connector->make());
    }

    public function customFields(): CustomFieldsResourceContract
    {
        return new CustomFieldsResource($this->connector->make());
    }

    public function debitNotes(): DebitNotesResourceContract
    {
        return new DebitNotesResource($this->connector->make());
    }

    public function debitNotesLineItems(): DebitNotesLineItemsResourceContract
    {
        return new DebitNotesLineItemsResource($this->connector->make());
    }

    public function employees(): EmployeesResourceContract
    {
        return new EmployeesResource($this->connector->make());
    }

    public function expenses(): ExpensesResourceContract
    {
        return new ExpensesResource($this->connector->make());
    }

    public function files(): FilesResourceContract
    {
        return new FilesResource($this->connector->make());
    }

    public function invoices(): InvoicesResourceContract
    {
        return new InvoicesResource($this->connector->make());
    }

    public function invoicesLineItems(): InvoicesLineItemsResourceContract
    {
        return new InvoicesLineItemsResource($this->connector->make());
    }

    public function itemUnitsOfMeasure(): ItemUnitsOfMeasureResourceContract
    {
        return new ItemUnitsOfMeasureResource($this->connector->make());
    }

    public function items(): ItemsResourceContract
    {
        return new ItemsResource($this->connector->make());
    }

    public function journalLineItems(): JournalLineItemsResourceContract
    {
        return new JournalLineItemsResource($this->connector->make());
    }

    public function manualJournals(): ManualJournalsResourceContract
    {
        return new ManualJournalsResource($this->connector->make());
    }

    public function paymentRequests(): PaymentRequestsResourceContract
    {
        return new PaymentRequestsResource($this->connector->make());
    }

    public function payments(): PaymentsResourceContract
    {
        return new PaymentsResource($this->connector->make());
    }

    public function payslips(): PayslipsResourceContract
    {
        return new PayslipsResource($this->connector->make());
    }

    public function payslipsPayItems(): PayslipsPayItemsResourceContract
    {
        return new PayslipsPayItemsResource($this->connector->make());
    }

    public function projects(): ProjectsResourceContract
    {
        return new ProjectsResource($this->connector->make());
    }

    public function purchaseOrders(): PurchaseOrdersResourceContract
    {
        return new PurchaseOrdersResource($this->connector->make());
    }

    public function purchaseOrdersLineItems(): PurchaseOrdersLineItemsResourceContract
    {
        return new PurchaseOrdersLineItemsResource($this->connector->make());
    }

    public function quotes(): QuotesResourceContract
    {
        return new QuotesResource($this->connector->make());
    }

    public function quotesLineItems(): QuotesLineItemsResourceContract
    {
        return new QuotesLineItemsResource($this->connector->make());
    }

    public function reports(): ReportsResourceContract
    {
        return new ReportsResource($this->connector->make());
    }

    public function revenueRecognitions(): RevenueRecognitionsResourceContract
    {
        return new RevenueRecognitionsResource($this->connector->make());
    }

    public function simplifiedInvoices(): SimplifiedInvoicesResourceContract
    {
        return new SimplifiedInvoicesResource($this->connector->make());
    }

    public function simplifiedInvoicesLineItems(): SimplifiedInvoicesLineItemsResourceContract
    {
        return new SimplifiedInvoicesLineItemsResource($this->connector->make());
    }

    public function taxRates(): TaxRatesResourceContract
    {
        return new TaxRatesResource($this->connector->make());
    }

    public function unitsOfMeasure(): UnitsOfMeasureResourceContract
    {
        return new UnitsOfMeasureResource($this->connector->make());
    }

    public function warehouses(): WarehousesResourceContract
    {
        return new WarehousesResource($this->connector->make());
    }
}
