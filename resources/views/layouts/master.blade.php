<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>


{{--The @section directive defines a section of content,
    while the @yield directive is used to display the contents of a given section.--}}