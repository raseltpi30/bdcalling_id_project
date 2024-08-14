<!doctype html>
<html lang="en">

<head>
    <title>Real State - @yield('title')</title>
    @include('website.includes.style')
</head>

<body>

    @include('website.includes.header')

    @yield('body')


    @include('website.includes.footer')


    @include('website.includes.script')
</body>

</html>
