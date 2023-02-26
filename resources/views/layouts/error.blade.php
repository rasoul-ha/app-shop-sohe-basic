<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('appTitle')
    <!-- App favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        @font-face {
            font-family: BYekan;
            src: url('/assets/css/fonts/BYekan-webfont.ttf');
        }

        body {
            background-color: #000;
            font-family: 'BYekan'
        }

        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }
    </style>
</head>

<body style="display: flex;justify-content: center;align-items: center;height: 97vh;">
    @yield('content')
</body>

</html>
