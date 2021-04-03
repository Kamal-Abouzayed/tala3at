@extends('dashboard.layouts.app')

@section('content')
    <form class="card shadow mb-4" action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('messages.create_n_story') }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text"
                        class="form-control"
                        name="title"
                        placeholder='{{ __('messages.s_title') }}'
                        autocomplete="title"
                        value="{{ old('title') }}"
                    >
                </div>
                <div class="form-group col-md-6">
                    <input type="text"
                        class="form-control"
                        name="type"
                        placeholder='{{ __('messages.s_type') }}'
                        autocomplete="type"
                        value="{{ old('type') }}"
                    >
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <select class="form-select form-control" id="governorate" name="governorate_id">
                        <option selected>{{ __('messages.select_governorate') }}</option>
                        @foreach ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">
                                {{ LaravelLocalization::getCurrentLocale() == 'ar' ? $governorate->governorate_name_ar : $governorate->governorate_name_en }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <select class="form-select form-control" id="city" name="city_id" aria-label="Default select example">
                        <option value="">{{ __('messages.select_city') }}</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-3">
                    <input class="form-control"
                        type="date"
                        name="date"
                        placeholder='{{ __('messages.date') }}'
                        required
                    >
                </div>

                <div class="form-group col-md-3">
                    <input class="form-control"
                        type="time"
                        name="time"
                        placeholder='{{ __('messages.time') }}'
                        required
                    >
                </div>

                <div class="form-group col-md-3">
                    <input type="number"
                        class="form-control"
                        placeholder='{{ __('messages.attendees') }}'
                        name="attendees"
                        value="{{ old('attendees') }}"
                    >
                </div>
            </div>


            <div class="form-group">
                <input type="file" name="image" value="{{ old('image') }}">
            </div>



            <div class="form-group">
                <textarea class="form-control" name="description" cols="100%" rows="10" placeholder="{{ __('messages.description') }}">{{ old('description') }}</textarea>

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

@push('java')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#governorate').on('change',function(e) {
                var governorate_id = $(this).children("option:selected").val();
                $.ajax({
                    url:"/admin/cities?governorate_id="+governorate_id,
                    type:"get",
                    data: {
                        governorate_id: governorate_id
                    },
                    success:function (data) {
                        // console.log(data);
                        $('#city').empty();
                        $.each(data.cities,function(index,city){
                            $('#city').append('<option value="'+city.id+'">'+city.city_name_ar+'</option>');
                        })
                    }
                })
            });
        });
    </script>
@endpush

