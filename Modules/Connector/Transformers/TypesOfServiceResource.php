<?php

namespace Modules\Connector\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class TypesOfServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     */
    public function toArray($request): array
    {
        $array = parent::toArray($request);

        $array['location_price_group'] = (object) $this->location_price_group;

        return $array;
    }
}
