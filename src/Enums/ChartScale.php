<?php

namespace Zorb\BOGConsole\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Minute()
 * @method static static Hour()
 * @method static static Day()
 * @method static static Week()
 * @method static static Month()
 */
final class ChartScale extends Enum
{
    const Minute = 'MINUTE';
    const Hour = 'HOUR';
    const Day = 'DAY';
    const Week = 'WEEK';
    const Month = 'MONTH';
}
