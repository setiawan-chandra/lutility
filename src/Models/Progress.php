<?php

namespace Kastanaz\Lutility\Models;

use Illuminate\Database\Eloquent\Model;
use Kastanaz\Lutility\Enums\ProgressStatusEnum;
use Kastanaz\Lutility\Concerns\HasPackageFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Kastanaz\Lutility\Contracts\ProgressModelContract;

class Progress extends Model
{
    use HasPackageFactory, HasUuids;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>|bool
     */
    protected $guarded = [];

    /**
     * Get the parent progressable model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function progressable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Generate Progress
     *
     * @param string $modelId
     * @param string $modelType
     * @param string $description
     * @param string $actorType
     * @param string $actorId
     * @return self
     */
    public static function generate(string $modelId, string $modelType, string $description, string $actorType, string $actorId): self
    {
        return self::create([
            'progressable_id' => $modelId,
            'progressable_type' => $modelType,
            'description' => $description,
            'actor_type' => $actorType,
            'actor_id' => $actorId
        ]);
    }

    /**
     * Check if Status is Running
     *
     * @return boolean
     */
    public function isRunning(): bool
    {
        return $this->status == ProgressStatusEnum::Running->value;
    }

    /**
     * Check if Status is Completed
     *
     * @return boolean
     */
    public function isCompleted(): bool
    {
        return $this->status == ProgressStatusEnum::Completed->value;
    }

    /**
     * Check if Status is Failed
     *
     * @return boolean
     */
    public function isFailed(): bool
    {
        return $this->status == ProgressStatusEnum::Failed->value;
    }

    /**
     * Set Progress to Complete
     *
     * @return void
     */
    public function setAsRunning(): void
    {
        $this->completed_at = null;
        $this->status = ProgressStatusEnum::Running->value;
        $this->save();
    }

    /**
     * Set Progress to Complete
     *
     * @return void
     */
    public function setAsCompleted(): void
    {
        $this->completed_at = now();
        $this->status = ProgressStatusEnum::Completed->value;
        $this->save();
    }

    /**
     * Set Progress to Failed
     *
     * @return void
     */
    public function setAsFailed(): void
    {
        $this->completed_at = null;
        $this->status = ProgressStatusEnum::Failed->value;
        $this->save();
    }

    /**
     * Get Actor Model
     *
     * @return Model
     */
    public function getActorModel(): Model
    {
        return $this->actor_type::find($this->actor_id);
    }
}
