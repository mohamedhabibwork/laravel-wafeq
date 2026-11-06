<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

use HWafeq\LaravelWafeq\Support\Zatca\ZatcaCodeLists;

/**
 * How the document is paid. Required on credit and debit notes, where
 * `issueReason` explains why the note was issued.
 *
 * `code` is a value from {@see ZatcaCodeLists::PAYMENT_MEANS_CODES}
 * (e.g. 10 cash, 30 credit transfer, 48 bank card).
 */
class ZatcaPaymentMeansData extends ZatcaPayloadData
{
    public function __construct(
        public ?string $code = null,
        public ?string $issueReason = null,
        public ?string $accountId = null,
        public ?string $paymentTerms = null,
    ) {}
}
