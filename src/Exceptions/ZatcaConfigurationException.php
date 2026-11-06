<?php

namespace HWafeq\LaravelWafeq\Exceptions;

/**
 * Thrown before any request is sent when the ZATCA configuration is
 * inconsistent, e.g. a `zatca_live_` key used against the simulation
 * environment, or an unknown environment value.
 */
class ZatcaConfigurationException extends WafeqException {}
