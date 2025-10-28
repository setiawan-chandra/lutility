<?php

namespace Kastanaz\Lutility\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Kastanaz\Lutility\Models\File;

trait Fileable
{
    /**
     * States
     *
     * @var array
     */
    private array $states = [
        'file_path' => null,
        'file' => null,
    ];

    /**
     * Get the file.
     */
    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * Get Save Disk Location
     *
     * @return string
     */
    public function getSaveDisk(): string
    {
        return $this->saveDisk;
    }

    /**
     * Store File
     *
     * @param  UploadedFile  $file
     * @param  string  $path
     * @return Model
     */
    public function storeFile(UploadedFile $file, string $path = '/'): Model
    {
        $this->states['file_path'] = $file->store($path, [
            'disk' => $this->getSaveDisk(),
        ]);

        $fileName = basename($this->states['file_path']);

        $this->states['file'] = $this->file()->create([
            'file_name' => $fileName,
            'file_path' => $this->states['file_path'],
            'disk' => $this->getSaveDisk(),
        ]);

        return $this->states['file'];
    }

    /**
     * Replace File
     *
     * @param  UploadedFile  $file
     * @param  string  $path
     * @return bool
     */
    public function replaceFile(UploadedFile $file, string $path = '/'): bool
    {
        $this->file->remove();

        $filePath = $file->store($path, [
            'disk' => $this->getSaveDisk(),
        ]);

        $fileName = basename($filePath);

        $result = $this->file->update([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'disk' => $this->getSaveDisk(),
        ]);

        return $result;
    }

    public function deleteAndRemove(): bool
    {
        $this->file->remove();

        $this->file->delete();

        $this->delete();

        return true;
    }

    /**
     * Rollback Store File
     *
     * @return void
     */
    public function rollback(): void
    {
        if (! is_null($this->states['file_path'])) {
            Storage::disk($this->getSaveDisk())->delete($this->states['file_path']);
        }
        if (! is_null($this->states['file'])) {
            $this->states['file']->delete();
        }
    }
}
