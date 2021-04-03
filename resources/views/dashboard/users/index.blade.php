@extends('dashboard.layouts.app')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('messages.create_n_user') }}</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>{{ __('messages.user_name') }}</th>
                        <th>{{ __('messages.user_email') }}</th>
                        <th>{{ __('messages.user_status') }}</th>
                        <th>{{ __('messages.govern') }}</th>
                        <th>{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_admin == 1)
                                    <span class="badge bg-primary text-white">Admin</span>
                                @else
                                    <span class="badge bg-success text-white">User</span>
                                @endif
                            </td>
                            <td>{{ LaravelLocalization::getCurrentLocale() == 'ar' ? $user->governorate->governorate_name_ar : $user->governorate->governorate_name_en  }}</td>
                            <td>
                                <div class="row">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-outline-info py-0 mx-2">
                                        {{ __('messages.update') }}
                                    </a>
                                    |
                                    <form action="{{ route('users.destroy', $user->id) }}"
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
