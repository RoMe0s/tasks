<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta http-equiv="x-ua-compatible" content="ie=edge">

    {!! Meta::render() !!}

    @section('styles')
        @include('partials.styles')
    @show

</head>

<body class="fixed-sn white-skin">

@include('partials.header')

@yield('content')

@section('buttons')

@show

<div id="popups">
    @section('popups')

    @show
</div>

<!-- /Start your project here-->

@include('partials.messages')

@section('scripts')
    @include('partials.scripts')
@show

</body>


</html>
