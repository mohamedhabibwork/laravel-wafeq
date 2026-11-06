<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * The ZATCA (Fatoora) environment a request is reported to.
 *
 * Sent on every ZATCA request as the `X-ZATCA-Environment` header.
 * `Simulation` targets the Fatoora simulation portal, where reported
 * documents are not submitted to the tax authority and are unlimited.
 *
 * @see https://docs.wafeq.com/zatca/report-a-simplified-invoice-to-zatca
 */
enum ZatcaEnvironment: string
{
    case Simulation = 'simulation';
    case Production = 'production';

    private const LIVE_KEY_PREFIX = 'zatca_live_';

    private const SIMULATION_KEY_PREFIX = 'zatca_sim_';

    /**
     * Infer the environment a dedicated ZATCA API key is scoped to.
     *
     * ZATCA keys start with `zatca_live_` or `zatca_sim_`; any other key
     * (a regular Wafeq API key or OAuth token) names no environment and
     * returns `null`.
     */
    public static function fromApiKey(string $apiKey): ?self
    {
        return match (true) {
            str_starts_with($apiKey, self::LIVE_KEY_PREFIX) => self::Production,
            str_starts_with($apiKey, self::SIMULATION_KEY_PREFIX) => self::Simulation,
            default => null,
        };
    }

    public function isSimulation(): bool
    {
        return $this === self::Simulation;
    }
}
