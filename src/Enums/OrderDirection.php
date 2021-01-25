<?php

namespace Zorb\BOGConsole\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Descending()
 * @method static static Ascending()
 */
final class OrderDirection extends Enum
{
    const Descending = 'DESC';
    const Ascending = 'ASC';
}
