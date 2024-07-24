<?php

namespace Kastanaz\Lutility\Services;

use ArrayAccess;
use Illuminate\Support\Collection;
use Kastanaz\Lutility\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Kastanaz\Lutility\Enums\SettingTypeEnum;
use Kastanaz\Lutility\UploadHandlers\GlobalFileUpload;
use Kastanaz\Lutility\UploadHandlers\ImageFileUpload;

class SettingService implements ArrayAccess
{
    /**
     * Container
     *
     * @var Collection
     */
    private Collection $container;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->container = $this->source();
    }

    /**
     * Source
     *
     * @return Collection
     */
    protected function source(): Collection
    {
        return Setting::all()->keyBy('key')->map(function($item) {
            return $item->value;
        });
    }

    /**
     * Check Offset Exist
     *
     * @param mixed $offset
     * @return boolean
     */
    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    /**
     * Get Data of Offset
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Set Data of Offset
     *
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unset Data of Offset
     *
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->container[$offset]);
    }

    /**
     * Get All Setting
     *
     * @return array
     */
    public function all(): array
    {
        return $this->container->map(function($value, $key) {
            return $this->formatValue($key, $value);
        })->toArray();
    }

    /**
     * Get Setting by Specific Key
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key): mixed
    {
        return $this->formatValue($key, $this->offsetGet($key));
    }

    /**
     * Put Setting Value With Specific Key
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public function put(string $key, mixed $value): bool
    {
        if ($this->getType($key) == SettingTypeEnum::Image && !$this->isUrl($value)) {
            $value = ImageFileUpload::upload($value, $this->offsetGet($key));
        }

        if ($this->getType($key) == SettingTypeEnum::File) {
            $value = GlobalFileUpload::upload($value, $this->offsetGet($key));
        }

        $this->offsetSet($key, $value);

        Setting::updateOrCreate(['key' => $key], [
            'value' => $value
        ]);

        return true;
    }

    public function storeAs(string $key, mixed $value, string $name): bool
    {
        if ($this->getType($key) == SettingTypeEnum::Image && !$this->isUrl($value)) {
            $value = ImageFileUpload::uploadAs($value, $this->offsetGet($key), $name);
        }

        if ($this->getType($key) == SettingTypeEnum::File) {
            $value = GlobalFileUpload::uploadAs($value, $this->offsetGet($key), $name);
        }

        $this->offsetSet($key, $value);

        Setting::updateOrCreate(['key' => $key], [
            'value' => $value
        ]);

        return true;
    }

    /**
     * Get Setting Type
     *
     * @param string $key
     * @return mixed
     */
    public function getType(string $key): mixed
    {
        return config('lutility.setting.list')[$key][0];
    }

    /**
     * Update Multiple Setting
     *
     * @param array $data
     * @return boolean
     */
    public function update(array $data): bool
    {
        foreach ($data as $key => $value) {
            $this->put($key, $value);
        }

        return true;
    }

    /**
     * Format Value
     *
     * @param string $key
     * @param mixed $value
     * @return mixed
     */
    protected function formatValue(string $key, mixed $value): mixed
    {
        if ($this->getType($key) == SettingTypeEnum::Image && ($value && !$this->isUrl($value))) {
            $value = Storage::disk($this->getUploadDisk(SettingTypeEnum::Image->value))->url($value);
        }

        if ($this->getType($key) == SettingTypeEnum::File && $value) {
            $value = Storage::disk($this->getUploadDisk(SettingTypeEnum::File->value))->url($value);
        }

        return $value;
    }

    /**
     * Check if Value is valid URL
     *
     * @param string $value
     * @return boolean
     */
    protected function isUrl(string $value): bool
    {
        return preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $value);
    }

    /**
     * Get Setting Upload Disk
     *
     * @param string $type
     * @return string
     */
    public function getUploadDisk(string $type): string
    {
        return config('lutility.setting.upload_disk')[$type];
    }
}
