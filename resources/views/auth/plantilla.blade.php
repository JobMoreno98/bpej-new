<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">
    <style>
        body {

            min-height: 100vh;
            display: flex;
            align-items: stretch;
            justify-content: center;

        }

        .btn-primary {
            --bs-btn-bg: #7c2422 !important;
            --bs-btn-border-color: #7c2422 !important;
            transition: ease-in-out .3s;
            --bs-btn-hover-bg: #990604 !important;
            --bs-btn-hover-border-color: #990604 !important;
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>
