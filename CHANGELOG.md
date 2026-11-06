# Changelog

All notable changes to `laravel-wafeq` will be documented in this file.

## Unreleased

### Added

- ZATCA e-invoicing client: `LaravelWafeq::zatca()` for the Wafeq ZATCA API, covering B2B clearance, B2C reporting, platform / white-label connected accounts, device onboarding, Group VAT branches, usage credits and the Fatoora **simulation** environment (the default).
- Every ZATCA document family (standard, simplified and prepayment invoices, credit and debit notes): report, validate, bulk report / validate, issue / bulk issue (simplified), list, retrieve, metadata update, PDF / XML download, retry and send.
- Typed ZATCA payload DTOs (`Data\Zatca\Payload`) with named constructors (`ZatcaTaxData::standard()`, `ZatcaLineItemData::make()`, `ZatcaChannelData::email()`, …), plus document enums and code lists.
- ZATCA FormRequests (`Requests\Zatca`) with family-specific rules that convert to the typed DTOs.
- `Testing\ZatcaFake`: offline fakes, error-response builders and assertions for applications testing their ZATCA integration.
- ZATCA exceptions: `ZatcaValidationException` (400, extends `ValidationException`), `ZatcaSubmissionException` (424) and `ZatcaConfigurationException`.
- Events: `ZatcaDocumentReported`, `ZatcaDocumentIssued`, `ZatcaDeviceRegistered`, `ZatcaConnectedAccountCreated`.
- `wafeq.zatca` config block (`WAFEQ_ZATCA_ENVIRONMENT`, `WAFEQ_ZATCA_API_KEY`, `WAFEQ_ZATCA_BASE_URL`, `WAFEQ_ZATCA_BRANCH`, `WAFEQ_ZATCA_CONNECTED_ACCOUNT`).

### Changed

- `ClientContract` gains a `zatca()` method. Custom implementations of the contract must add it.

