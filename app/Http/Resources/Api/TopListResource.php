<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TopListResource extends JsonResource
{
    public static function collection($resource): ResourceCollection
    {
        return new ResourceCollection($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'brand_id' => $this->brand_id,
            'position' => $this->position,
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->brand_name,
                'image' => $this->brand->brand_image,
            ],
            'country' => [
                'id' => $this->country->id,
                'code' => $this->country->code,
                'name' => $this->country->name,
            ],
        ];
    }

    public static function fromCountryTopList($topList)
    {
        return self::collection($topList->map(function ($item): TopListResource {
            return new self($item);
        }));
    }
}
