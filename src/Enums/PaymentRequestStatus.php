<?php

namespace HWafeq\LaravelWafeq\Enums;

/**
 * PaymentRequestStatusEnum mirrors the Wafeq `PaymentRequestStatusEnum`
 * schema. Returned by `status` on the PaymentRequest resource.
 *
 * @method static self Deleted()
 * @method static self Draft()
 * @method static self Error()
 * @method static self FetchingStatus()
 * @method static self NotFound()
 * @method static self PendingApproval()
 * @method static self PendingRelease()
 * @method static self Processed()
 * @method static self Processing()
 * @method static self Queued()
 * @method static self Rejected()
 * @method static self Released()
 * @method static self Validated()
 *
 * @see LaravelWafeq
 */
enum PaymentRequestStatus: string
{
    case Deleted = 'DELETED';
    case Draft = 'DRAFT';
    case Error = 'ERROR';
    case FetchingStatus = 'FETCHING_STATUS';
    case NotFound = 'NOT_FOUND';
    case PendingApproval = 'PENDING_APPROVAL';
    case PendingRelease = 'PENDING_RELEASE';
    case Processed = 'PROCESSED';
    case Processing = 'PROCESSING';
    case Queued = 'QUEUED';
    case Rejected = 'REJECTED';
    case Released = 'RELEASED';
    case Validated = 'VALIDATED';
}
