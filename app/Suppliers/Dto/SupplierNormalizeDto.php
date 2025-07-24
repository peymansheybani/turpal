<?php

namespace App\Suppliers\Dto;

use Illuminate\Contracts\Support\Arrayable;

class SupplierNormalizeDto implements Arrayable
{
    public function __construct(
        public string $id,
        public string $title,
        public string $description,
        public string $city,
        public string $country,
        public string $price
    )
    {
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'city' => $this->city,
            'country' => $this->country,
            'price' => $this->price
        ];
    }
}
