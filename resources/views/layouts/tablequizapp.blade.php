<!DOCTYPE html>
<html lang="en">
    <head>
        
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html;" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="theme-color" content="#3124af">
        <meta name="description" content="">
        <link rel="icon" type="image/png" href="/favicon.png" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.typekit.net/ebh0ltv.css">
        <!-- Replace this with 3D slider -->
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
        <!-- end -->
        <link rel="stylesheet" href="{{asset('site_design/css/style.css')}}">
        
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tablequiz</title>
     


        {{-- Fonts --}}
        @yield('template_linked_fonts')

        {{-- Styles --}}
        

        @yield('template_linked_css')

        <style type="text/css">
            @yield('template_fastload_css')

        </style>

        {{-- Scripts --}}
        <script>
            window.Laravel = {!! json_encode([
                'csrfToken' => csrf_token(),
            ]) !!};
        </script>


        @yield('head')
        
    </head>
    <body>
 
        <script src="https://use.fontawesome.com/releases/v5.3.0/js/all.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

        <!-- Replace below with 3d Slider -->
        <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
        <!-- end -->
        <script src="{{asset('site_design/js/scripts.js?version=20')}}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

        <script src="https://use.fontawesome.com/releases/v5.3.0/js/all.js"></script>

        <script src="https://use.fontawesome.com/releases/v5.3.0/js/all.js"></script>

        {{-- Scripts --}}
        @yield('footer_scripts')

        @include('partials.tablequiz.head')

            <main class="container-fluid page-wrap d-flex">

                @yield('content')

            </main>

            @include('partials.tablequiz.footer')
        

            @include('partials.tablequiz.sign-up__modal')



    </body>
</html>
