<?php

namespace Zorb\BOGConsole\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Card()
 * @method static static CardId()
 * @method static static ApplePay()
 */
final class SourceType extends Enum
{
    const Card = 'CARD';
    const CardId = 'CARD_ID';
    const ApplePay = 'APPLE_PAY';
}
