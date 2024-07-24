<?php

namespace Kastanaz\Lutility\Contracts;

interface UploadHandlerContract
{
    /**
     * Get upload disk contract
     *
     * @return string
     */
    public static function getDisk(): string;

    /**
     * Upload Handler contract
     *
     * @param any $value
     * @param any $setting
     * @return string
     */
    public static function upload($value, $setting): string;

    /**
     * Upload Handler As Name contract
     *
     * @param any $value
     * @param any $setting
     * @param string $as
     * @return string
     */
    public static function uploadAs($value, $setting, string $as): string;
}
