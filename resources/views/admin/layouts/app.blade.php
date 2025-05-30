<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('backoffice-title') | Hangout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="{{ asset('template/backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/backend/css/app.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />
    <script src="{{ asset('template/backend/js/config.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
</head>

<body>
    <div id="wrapper">
        @include('admin.layouts.navbar')
        @include('admin.layouts.sidebar')
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @yield('backoffice-content')
                </div>

            </div>
        </div>
    </div>
    <script src="{{ asset('template/backend/js/vendor.min.js') }}"></script>
    <script src="{{ asset('template/backend/js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
