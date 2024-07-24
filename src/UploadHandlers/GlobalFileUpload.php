<?php

namespace Kastanaz\Lutility\UploadHandlers;

use Kastanaz\Lutility\Contracts\UploadHandlerContract;
use Kastanaz\Lutility\Enums\SettingTypeEnum;
use Kastanaz\Lutility\UploadHandlers\Concerns\UploadHandlerConcern;

class GlobalFileUpload implements UploadHandlerContract
{
    use UploadHandlerConcern;

    /**
     * Get upload disk
     *
     * @return string
     */
    public static function getDisk(): string
    {
        return config('lutility.setting.upload_disk')[SettingTypeEnum::File->value];
    }
}
