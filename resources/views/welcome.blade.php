<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">

    @yield('title')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    @yield('styles')
</head>

<body>
@include('includes.header')

@yield('content')

@include('includes.footer')




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('js/jquery.validate.js')}}"></script>
<script src="{{asset('js/additional-methods.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
@if (session('success'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{!! session('success') !!}'
        })
    </script>
@endif
@if (session('alert'))
    <script type="text/javascript">
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: "{!! session('alert') !!}",
        })
    </script>
@endif
<script>
    window.onload = function() {
        document.querySelector('#scroll-div').scrollIntoView({
            behavior: 'smooth'
        });
    }
</script>
@yield('scripts')

</body>

</html>
