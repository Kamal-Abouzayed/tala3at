@extends('dashboard.layouts.app')

@section('content')
    <div class="row">
        {{-- Users --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">{{ __('messages.users') }}</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $users->count() }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-3x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>

        {{-- Stories --}}
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">{{ __('messages.stories') }}</div>
                    <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $stories->count() }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-bookmark fa-3x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-4 mb-4">
        <h1 class="text-gray-800">{{ __('messages.latest_stories') }}</h1>
    </div>
    <div class="col-md-8 ">
        @if ($stories->count() > 0)
            @foreach ($stories as $story)
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
        @else
            <div class="alert alert-danger" role="alert">
                A simple danger alert—check it out!
            </div>
        @endif
    </div>

@endsection

