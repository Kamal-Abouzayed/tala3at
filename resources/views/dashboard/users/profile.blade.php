@extends('dashboard.layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4 mx-auto">
        <div class="card shadow" style="width: 25rem;">
            <div class="col-md-4 mx-auto">
                <img src="{{ asset('/images').'/'.$user->image }}" class="rounded-circle shadow mt-3 mx-auto" style="width: 100%" alt="...">
            </div>

            <div class="card-body">
            <h2 class="card-title text-center">{{ $user->name }}</h2>
            <p class="card-text text-center">{{ $user->email }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-7 mx-auto">
        @foreach ($user->story->all() as $story)
                <div class="card shadow mb-3">
                    <div>
                        <img src="{{ asset('/images').'/'.$story->image }}" class="img-fluid" height="100%" alt="...">
                    </div>

                    <div class="card-body">
                    <h3 class="card-title">{{ $story->title }}</h3>
                    <h4 class="card-text"><span class="badge bg-success text-white">{{ $story->type }}</span></h4>
                    <p>{{ __('messages.created_by') }} : {{ $story->user->name }}</p>
                    <p>
                        <i class="fas fa-map-marker-alt"></i>
                        {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $story->governorate->governorate_name_ar : $story->governorate->governorate_name_en }} ,
                        {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $story->city->city_name_ar : $story->city->city_name_en }}
                    </p>
                    <p>
                        <i class="fas fa-calendar-day"></i>
                        {{ $story->date }} - {{ \Carbon\Carbon::parse($story->time)->format('h:i A') }}
                    </p>
                    <p>{{ __('messages.attendees')}} : {{ $story->attendees  }} </p>
                    <hr>
                    <h5>{{ __('messages.description') }}</h5>
                    <p class="card-text">{{ $story->description }}</p>
                    <hr>
                    <p class="card-text">
                        {{ __('messages.created_at') }} :
                        <small class="text-muted">{{ \Carbon\Carbon::parse( $story->created_at)->format('d-m-Y') }}</small>
                    </p>
                    </div>
                </div>
        @endforeach
    </div>


</div>

@endsection

