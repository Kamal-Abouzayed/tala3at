@extends('dashboard.layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('stories.create') }}" class="btn btn-primary">{{ __('messages.create_n_story') }}</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('messages.s_title') }}</th>
                        <th>{{ __('messages.s_type') }}</th>
                        <th>{{ __('messages.govern') }}</th>
                        <th>{{ __('messages.city') }}</th>
                        <th>{{ __('messages.date') }}</th>
                        <th>{{ __('messages.time') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stories as $story)
                        <tr>
                            <td>{{ $story->id }}</td>
                            <td>{{ $story->title }}</td>
                            <td>{{ $story->type }}</td>
                            <td>
                                {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $story->governorate->governorate_name_ar : $story->governorate->governorate_name_en  }}
                            </td>
                            <td>
                                {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $story->city->city_name_ar : $story->city->city_name_en }}
                            </td>
                            <td>{{ $story->date }}</td>
                            <td>{{ $story->time }}</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('stories.edit', $story->id) }}"
                                        class="btn btn-sm btn-outline-info py-0 mx-2">
                                        {{ __('messages.update') }}
                                    </a>
                                    |
                                    <form action="{{ route('stories.destroy', $story->id) }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger py-0 mx-2">
                                            {{ __('messages.delete') }}
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
