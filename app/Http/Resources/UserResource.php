<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'is_admin' => $this->is_admin == 1 ? 'Yes' : 'No',
            'governorate_name' => LaravelLocalization::getCurrentLocale() == 'ar' ? $this->governorate->governorate_name_ar : $this->governorate->governorate_name_en,
            'image' => $this->image,
        ];
    }
}
