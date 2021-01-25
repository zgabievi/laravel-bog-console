<?php

namespace Zorb\BOGConsole\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Hidden()
 * @method static static Unverified()
 * @method static static Verified()
 * @method static static VerificationFailed()
 * @method static static Verifying()
 */
final class CardStatus extends Enum
{
    const Hidden = 'HIDDEN';
    const Unverified = 'UNVERIFIED';
    const Verified = 'VERIFIED';
    const VerificationFailed = 'VERIFICATION_FAILED';
    const Verifying = 'VERIFYING';
}
