@extends('dashboard.layouts.app')

@section('content')
    <form class="card shadow mb-4" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.create_n_user') }}</h6>
        </div>
        <div class="card-body">
            <div class="form-group">
                <input type="text"
                    class="form-control"
                    name="name"
                    placeholder='{{ __('messages.user_name') }}'
                    autocomplete="name"
                    value="{{ old('name') }}"
                >
            </div>
            <div class="form-group">
                <input type="email"
                    class="form-control"
                    name="email"
                    placeholder='{{ __('messages.user_email') }}'
                    autocomplete="email"
                    value="{{ old('email') }}"
                >
            </div>
            <div class="form-group">
                <select class="form-select form-control" name="governorate_id">
                    <option selected>{{ __('messages.select_governorate') }}</option>
                    @foreach ($governorates as $governorate)
                        <option value="{{ $governorate->id }}">
                            {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $governorate->governorate_name_ar : $governorate->governorate_name_en }}
                        </option>
                    @endforeach
                </select>
            </div>
            {{-- <div class="form-group">
                <select class="form-select form-control" name="cities" aria-label="Default select example">
                    <option value="" selected>{{ __('messages.select_city') }}</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">
                            {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $city->city_name_ar : $city->city_name_en }}
                        </option>
                    @endforeach
                </select>
            </div> --}}

            <div class="form-group">
                <input type="file" name="image" value="{{ old('image') }}">
            </div>

            <div class="form-group">
                <input type="password"
                    class="form-control"
                    placeholder='{{ __('messages.password') }}'
                    name="password"
                    value="{{ old('password') }}"
                >
            </div>


            <div>
                <button type="submit" class="btn btn-primary">{{ __('messages.save') }}</button>
            </div>
        </div>
    </form>
@endsection

@if ($errors->count() > 0)
    @foreach ($errors->all() as $error)
        @push('js')
            <script type="text/javascript">
                $(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    Toast.fire({
                        icon: 'error',
                        title: '{{ $error }}',
                    })
                });
            </script>
        @endpush
    @endforeach
@endif

