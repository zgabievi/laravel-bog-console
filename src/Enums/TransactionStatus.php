<?php

namespace Zorb\BOGConsole\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Declined()
 * @method static static Error()
 * @method static static Processing()
 * @method static static Success()
 * @method static static InterimSuccess()
 * @method static static Finished()
 */
final class TransactionStatus extends Enum
{
    const Declined = 'DECLINED';
    const Error = 'ERROR';
    const Processing = 'PROCESSING';
    const Success = 'SUCCESS';
    const InterimSuccess = 'INTERIM_SUCCESS';
    const Finished = 'FINISHED';
}
