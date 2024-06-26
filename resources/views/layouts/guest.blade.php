<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body class="sign-in-body">
<div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/additional-methods.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    jQuery.validator.addMethod("password", function (value, element) {
            var result = this.optional(element) || value.length >= 8 && /\d/.test(value) && /[A-Z]/.test(value) &&
                /[a-z]/.test(value);
            return result;
        },
        "Password must be at least 8 characters long.<br> Password must have one number.<br> Password must have one special character.<br> Password must have one uppercase letter.<br> Password must have one lowercase letter."
    )
    jQuery.validator.addMethod("checkFileUploaded", function (value, element) {
            var result = this.optional(element) || value == 'no' || is_file > 0;
            return result;
        },
        "Please upload atleast one document"
    )
    $('#register-form').validate({
        rules: {
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            phone: {
                required: true
            },
            email: {
                required: true
            },
            username: {
                required: true
            },
            password: {
                required: true,
                password: true
            },
            password_confirmation: {
                required: true,
                // password: true
                equalTo: "#password"
            },
            accredited_investor: {
                required: true,
                checkFileUploaded: true
            },
            // recieve_digi_updates: {
            //     required: true
            // },
        },
        messages: {
            first_name: {
                required: "This field is required"
            },
            last_name: {
                required: "This field is required"
            },
            phone: {
                required: "This field is required"
            },
            email: {
                required: "This field is required"
            },
            username: {
                required: "This field is required"
            },
            password: {
                required: "This field is required"
            },
            password_confirmation: {
                equalTo: "Password does not match"
            },
            accredited_investor: {
                required: "This field is required"
            },
            // recieve_digi_updates: {
            //     required: "This field is required"
            // },
        },
        // errorElement : 'div',
        errorPlacement: function(error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
</script>
</body>
</html>
