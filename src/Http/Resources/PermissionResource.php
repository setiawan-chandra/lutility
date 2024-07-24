<?php

namespace Kastanaz\Lutility\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'create' => (bool) $data['create'],
            'read' => (bool) $data['read'],
            'update' => (bool) $data['update'],
            'delete' => (bool) $data['delete'],
            'restore' => (bool) $data['restore'],
            'manage_all' => (bool) $data['manage_all'],
        ]);
    }
}
