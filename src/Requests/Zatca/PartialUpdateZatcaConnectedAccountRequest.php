<?php

declare(strict_types=1);

namespace HWafeq\LaravelWafeq\Requests\Zatca;

/**
 * FormRequest for `PATCH /zatca/connected-accounts/{id}/` — every field is
 * optional, but any field sent must satisfy the create rules.
 */
class PartialUpdateZatcaConnectedAccountRequest extends CreateZatcaConnectedAccountRequest
{
    protected function presence(): string
    {
        return 'sometimes';
    }
}
