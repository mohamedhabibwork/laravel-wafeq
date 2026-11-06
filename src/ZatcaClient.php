<?php

namespace HWafeq\LaravelWafeq;

use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaClientContract;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaConnectedAccountsResourceContract;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaDevicesResourceContract;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaDocumentsResourceContract;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaSimplifiedDocumentsResourceContract;
use HWafeq\LaravelWafeq\Contracts\Zatca\ZatcaUsageResourceContract;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaDocumentType;
use HWafeq\LaravelWafeq\Enums\Zatca\ZatcaEnvironment;
use HWafeq\LaravelWafeq\Exceptions\ZatcaConfigurationException;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaConnectedAccountsResource;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaDevicesResource;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaDocumentsResource;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaSimplifiedDocumentsResource;
use HWafeq\LaravelWafeq\Resources\Zatca\ZatcaUsageResource;

/**
 * Immutable, scoped client for the Wafeq ZATCA API.
 *
 * Defaults come from the `wafeq.zatca` config; each `with*` / `for*`
 * method returns a re-scoped copy.
 *
 * @see ZatcaClientContract
 */
final class ZatcaClient implements ZatcaClientContract
{
    private const string HEADER_ENVIRONMENT = 'X-ZATCA-Environment';

    private const string HEADER_BRANCH = 'X-ZATCA-Branch';

    private const string HEADER_CONNECTED_ACCOUNT = 'X-ZATCA-Connected-Account-Id';

    private readonly ZatcaEnvironment $environment;

    private readonly ?string $branch;

    private readonly ?string $connectedAccount;

    public function __construct(
        private readonly Connector $connector,
        ZatcaEnvironment|string|null $environment = null,
        ?string $branch = null,
        ?string $connectedAccount = null,
    ) {
        $config = $connector->zatcaConfig();

        $this->environment = self::resolveEnvironment($environment ?? ($config['environment'] ?? null), $connector->zatcaApiKey());
        $this->branch = self::nonEmpty($branch ?? ($config['branch'] ?? null));
        $this->connectedAccount = self::nonEmpty($connectedAccount ?? ($config['connected_account'] ?? null));
    }

    public function environment(): ZatcaEnvironment
    {
        return $this->environment;
    }

    public function branch(): ?string
    {
        return $this->branch;
    }

    public function connectedAccount(): ?string
    {
        return $this->connectedAccount;
    }

    public function withEnvironment(ZatcaEnvironment|string $environment): static
    {
        return new self($this->connector, $environment, $this->branch ?? '', $this->connectedAccount ?? '');
    }

    public function simulation(): static
    {
        return $this->withEnvironment(ZatcaEnvironment::Simulation);
    }

    public function production(): static
    {
        return $this->withEnvironment(ZatcaEnvironment::Production);
    }

    public function forBranch(?string $branch): static
    {
        return new self($this->connector, $this->environment, $branch ?? '', $this->connectedAccount ?? '');
    }

    public function forConnectedAccount(?string $connectedAccountId): static
    {
        return new self($this->connector, $this->environment, $this->branch ?? '', $connectedAccountId ?? '');
    }

    public function headers(): array
    {
        return array_filter([
            self::HEADER_ENVIRONMENT => $this->environment->value,
            self::HEADER_BRANCH => $this->branch,
            self::HEADER_CONNECTED_ACCOUNT => $this->connectedAccount,
        ], static fn (?string $value): bool => $value !== null);
    }

    /**
     * Connected accounts are managed by the platform itself, so these
     * requests carry no environment / branch / connected-account scope.
     */
    public function connectedAccounts(): ZatcaConnectedAccountsResourceContract
    {
        return new ZatcaConnectedAccountsResource($this->connector->makeZatca());
    }

    public function devices(): ZatcaDevicesResourceContract
    {
        return new ZatcaDevicesResource($this->connector->makeZatca($this->headers()));
    }

    /**
     * Usage is organisation-wide and takes no ZATCA scoping headers.
     */
    public function usage(): ZatcaUsageResourceContract
    {
        return new ZatcaUsageResource($this->connector->makeZatca());
    }

    public function documents(ZatcaDocumentType $type): ZatcaDocumentsResourceContract
    {
        $http = $this->connector->makeZatca($this->headers());

        return $type->isSimplified()
            ? new ZatcaSimplifiedDocumentsResource($http, $type)
            : new ZatcaDocumentsResource($http, $type);
    }

    public function invoices(): ZatcaDocumentsResourceContract
    {
        return $this->documents(ZatcaDocumentType::Invoice);
    }

    public function creditNotes(): ZatcaDocumentsResourceContract
    {
        return $this->documents(ZatcaDocumentType::CreditNote);
    }

    public function debitNotes(): ZatcaDocumentsResourceContract
    {
        return $this->documents(ZatcaDocumentType::DebitNote);
    }

    public function prepaymentInvoices(): ZatcaDocumentsResourceContract
    {
        return $this->documents(ZatcaDocumentType::PrepaymentInvoice);
    }

    public function simplifiedInvoices(): ZatcaSimplifiedDocumentsResourceContract
    {
        return $this->simplified(ZatcaDocumentType::SimplifiedInvoice);
    }

    public function simplifiedCreditNotes(): ZatcaSimplifiedDocumentsResourceContract
    {
        return $this->simplified(ZatcaDocumentType::SimplifiedCreditNote);
    }

    public function simplifiedDebitNotes(): ZatcaSimplifiedDocumentsResourceContract
    {
        return $this->simplified(ZatcaDocumentType::SimplifiedDebitNote);
    }

    public function prepaymentSimplifiedInvoices(): ZatcaSimplifiedDocumentsResourceContract
    {
        return $this->simplified(ZatcaDocumentType::PrepaymentSimplifiedInvoice);
    }

    private function simplified(ZatcaDocumentType $type): ZatcaSimplifiedDocumentsResourceContract
    {
        return new ZatcaSimplifiedDocumentsResource($this->connector->makeZatca($this->headers()), $type);
    }

    /**
     * Resolve the environment and make sure a dedicated ZATCA key agrees with it.
     */
    private static function resolveEnvironment(mixed $environment, string $apiKey): ZatcaEnvironment
    {
        $keyEnvironment = ZatcaEnvironment::fromApiKey($apiKey);

        $resolved = match (true) {
            $environment instanceof ZatcaEnvironment => $environment,
            is_string($environment) && $environment !== '' => ZatcaEnvironment::tryFrom(strtolower($environment))
                ?? throw new ZatcaConfigurationException("Unknown ZATCA environment [{$environment}]. Use \"simulation\" or \"production\"."),
            default => $keyEnvironment ?? ZatcaEnvironment::Simulation,
        };

        if ($keyEnvironment !== null && $keyEnvironment !== $resolved) {
            throw new ZatcaConfigurationException(
                "The configured ZATCA API key is scoped to [{$keyEnvironment->value}] but the [{$resolved->value}] environment was requested."
            );
        }

        return $resolved;
    }

    private static function nonEmpty(mixed $value): ?string
    {
        return is_string($value) && $value !== '' ? $value : null;
    }
}
