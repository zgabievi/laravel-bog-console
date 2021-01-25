<?php

namespace Zorb\BOGConsole\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CardToCard()
 * @method static static CardToCash()
 * @method static static Payment()
 * @method static static Acquiring()
 */
final class TransactionType extends Enum
{
    const CardToCard = 'CARD_TO_CARD';
    const CardToCash = 'CARD_TO_CASH';
    const Payment = 'PAYMENT';
    const Acquiring = 'ACQUIRING';
}
