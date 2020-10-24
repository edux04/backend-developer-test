<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.meta')
</head>

<body>

@include('layouts.partials.header')

<div class="container">
    @yield('content')
    <div id='app'>
    @yield('component')
    </div>
</div>


</body>

<script src="{{mix('js/app.js')}}"></script>

</html>
