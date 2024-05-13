<!DOCTYPE html>
<html dir="rtl" lang="fa">
<!--Head::start-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css'])
</head>
<!--Head::end-->

<!--Body::start-->

<body>
    @yield('content')
</body>
<!--Body::end-->

</html>