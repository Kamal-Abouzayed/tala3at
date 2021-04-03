@include('dashboard.layouts.header')
@include('dashboard.layouts.sidebar')
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        @include('dashboard.layouts.navbar')
        <div class="container-fluid">
            @include('sweetalert::alert')
            @yield('content')
        </div>
    </div>
    <!-- End of Main Content -->

@include('dashboard.layouts.footer')
