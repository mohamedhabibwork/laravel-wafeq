<?php

namespace HWafeq\LaravelWafeq\Enums\Zatca;

/**
 * File format returned by the ZATCA document download endpoint.
 *
 * `Pdf` is a PDF/A-3 with the signed XML embedded.
 */
enum ZatcaDownloadType: string
{
    case Pdf = 'pdf';
    case Xml = 'xml';
}
