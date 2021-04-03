<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class StoryResource extends JsonResource
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
            'title' => $this->title,
            'type' => $this->type,
            'description'  => $this->description,
            'image' => $this->image,
            'date' => $this->date,
            'time' => Carbon::parse($this->time)->format('h:i A'),
            'attendees' => $this->attendees,
            'governorate_name' => LaravelLocalization::getCurrentLocale() == 'ar' ? $this->governorate->governorate_name_ar : $this->governorate->governorate_name_en,
            'city_name' => LaravelLocalization::getCurrentLocale() == 'ar' ? $this->city->city_name_ar : $this->city->city_name_en,
            'user' => new UserResource($this->user),
        ];
    }
}
