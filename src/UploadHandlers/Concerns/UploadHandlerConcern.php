<?php

namespace Kastanaz\Lutility\UploadHandlers\Concerns;

use Illuminate\Support\Facades\Storage;

trait UploadHandlerConcern
{
    /**
     * Upload Handler
     *
     * @param any $value
     * @param any $setting
     * @return string
     */
    public static function upload($value, $setting): string
    {
        $disk = self::getDisk();

        if ($setting) {
            Storage::disk($disk)->delete($setting);
        }

        $value = $value->store('/', ['disk' => $disk]);
        return $value;
    }

    /**
     * Upload Handler As Name
     *
     * @param any $value
     * @param any $setting
     * @param string $setting
     * @return string
     */
    public static function uploadAs($value, $setting, string $as): string
    {
        $disk = self::getDisk();

        if ($setting) {
            Storage::disk($disk)->delete($setting);
        }

        $name = $as . '.' . $value->getClientOriginalExtension();
        $value = $value->storeAs('/', $name, ['disk' => $disk]);
        return $value;
    }
}
