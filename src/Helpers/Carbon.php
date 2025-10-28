<?php

namespace Kastanaz\Lutility\Helpers;

use Carbon\Carbon as BaseCarbon;

class Carbon
{
    /**
     * Get Parse With User Timezone
     *
     * @param mixed $time
     * @param mixed $tz
     * @return \Carbon\Carbon
     */
    public static function parseTimezone(mixed $time = null, mixed $tz = null): \Carbon\Carbon
    {
        return BaseCarbon::parse($time, $tz)->setTimezone(auth()->user()->timezone);
    }
}
