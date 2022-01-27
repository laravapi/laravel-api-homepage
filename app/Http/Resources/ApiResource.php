<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'key' => $this->key,
            'name' => $this->name,
            'wrapperClass' => $this->wrapper_class,
            'wrapperPackage' => $this->wrapper_package,
            'apiPackage' => $this->api_package,
            'description' => $this->description,
        ];
    }
}
