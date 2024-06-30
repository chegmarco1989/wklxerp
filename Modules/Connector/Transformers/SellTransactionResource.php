<?php

namespace Modules\Connector\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;

class SellTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
