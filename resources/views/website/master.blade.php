<!doctype html>
<html lang="en">

<head>
    <title>Real State - @yield('title')</title>
    <link rel="shortcut icon"
    href="https://assets-global.website-files.com/6620c39e0f73c5b63cb850e8/6621148aee02d0fde5537ee1_Hertiage%20Nest%20-%20Final%20LOGO%20(1)%201.png"
    type="image/x-icon">
    @include('website.includes.style')
</head>

<body>

    @include('website.includes.header')

    @yield('body')


    @include('website.includes.footer')


    @include('website.includes.script')
</body>

</html>
