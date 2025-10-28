<?php

namespace Kastanaz\Lutility\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get the parent fileable model.
     */
    public function fileable()
    {
        return $this->morphTo();
    }

    /**
     * Delete Actual File
     *
     * @return bool
     */
    public function remove(): bool
    {
        return Storage::disk($this->disk)->delete($this->file_path);
    }

    /**
     * Get File URL
     *
     * @return string
     */
    public function url(): string
    {
        return Storage::disk($this->disk)->url($this->file_path);
    }

    /**
     * Get File Path
     *
     * @return void
     */
    public function path()
    {
        return Storage::disk($this->disk)->path($this->file_path);
    }
}
