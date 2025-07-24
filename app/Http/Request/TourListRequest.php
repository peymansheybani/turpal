<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TourListRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            "page" => "nullable|integer",
            "limit" => "nullable|integer",
        ];
    }
}
