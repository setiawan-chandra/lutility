<?php

namespace Kastanaz\Lutility\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        return array_merge($data, [
            'human_completed_at' => Carbon::parse($data['completed_at'])->diffForHumans()
        ]);
    }
}
