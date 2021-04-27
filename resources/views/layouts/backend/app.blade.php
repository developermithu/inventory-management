<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Startar Kit | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />

    <!--  FavIcon  Icon-->
    {{-- <link rel="shortcut icon" href="{{Storage::url(setting('site_favicon'))}}"> --}}
    <!-- Meta Tag -->
    <meta name="description" content="Mithu is a full-stack web and wordpress developer who love to design & develop website.">
    <meta name="keywords" content="developermithu, webdevelopermithu, full-satck webdevelopermithu,mithu, mithu das, mithu105">
    <meta name="author" content="developermithu" />

    <link href="{{asset('main.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @stack('css')
    </head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        
        {{-- Header --}}
        @include(' layouts.backend.partials.header')
        {{-- Header --}}

        <div class="app-main">
            
            {{-- Sidebar --}}
            @include('layouts.backend.partials.sidebar')
            {{-- Sidebar --}}

                 <div class="app-main__outer">

                   {{-- Main --}}
                   @yield('content')
                   {{-- Main --}}

                    {{-- Footer  --}}
                    @include('layouts.backend.partials.footer')
                    {{-- Footer  --}}

                </div>
        </div>
    </div>


<script type="text/javascript" src="{{asset('assets/scripts/main.js')}}"></script>
<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
<script type="text/javascript" src="{{asset('js/script.js')}}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@stack('js')

<script>
    // Dynamic Delete
 function removeData(id) {
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then(function (result) {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
        });
    }
</script>
</body>
</html>
