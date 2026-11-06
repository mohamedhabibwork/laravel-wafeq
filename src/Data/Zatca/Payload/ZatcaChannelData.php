<?php

namespace HWafeq\LaravelWafeq\Data\Zatca\Payload;

/**
 * A delivery channel for a ZATCA document. Email is the only medium.
 *
 * ```php
 * ZatcaChannelData::email('customer@example.com', 'Your invoice', 'Thank you!');
 * ```
 */
class ZatcaChannelData extends ZatcaPayloadData
{
    public const MEDIUM_EMAIL = 'email';

    /**
     * @param  array{recipients: array{to: list<string>, cc?: list<string>, bcc?: list<string>}, subject: string, message: string}  $data
     */
    public function __construct(
        public string $medium,
        public array $data,
    ) {}

    /**
     * @param  string|list<string>  $to  Up to 6 recipients.
     * @param  list<string>  $cc
     * @param  list<string>  $bcc
     */
    public static function email(string|array $to, string $subject, string $message, array $cc = [], array $bcc = []): self
    {
        $recipients = ['to' => array_values((array) $to)];

        if ($cc !== []) {
            $recipients['cc'] = $cc;
        }

        if ($bcc !== []) {
            $recipients['bcc'] = $bcc;
        }

        return new self(self::MEDIUM_EMAIL, [
            'recipients' => $recipients,
            'subject' => $subject,
            'message' => $message,
        ]);
    }
}
