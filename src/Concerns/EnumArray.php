<?php

namespace Kastanaz\Lutility\Concerns;

use Illuminate\Support\Str;

trait EnumArray
{
    /**
     * Convert Enum To Array Key Value
     *
     * @return array
     */
    public static function toArray(): array
    {
        return collect(self::cases())->map(function($item) {
            return [
                'name' => $item->name,
                'value' => $item->value,
            ];
        })->toArray();
    }

    /**
     * Convert Enum To Array Key Value With Uppercase Key
     *
     * @return array
     */
    public static function toArrayUpper()
    {
        return collect(self::cases())->map(function($item) {
            return [
                'name' => Str::upper($item->name),
                'value' => $item->value,
            ];
        })->toArray();
    }

    /**
     * Convert Enum To Array Key Value With Lowercase Key
     *
     * @return array
     */
    public static function toArrayLower()
    {
        return collect(self::cases())->map(function($item) {
            return [
                'name' => Str::lower($item->name),
                'value' => $item->value,
            ];
        })->toArray();
    }
}
