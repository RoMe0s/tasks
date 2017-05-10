<!-- Start your project here-->

<!--Navbar-->

<nav class="navbar fixed-top navbar-toggleable-md navbar-dark scrolling-navbar double-nav">

    <!-- Breadcrumb-->

    <div @if(!$user) style="margin: 0 auto;" @endif>

        <a {!! check_current_url(route('home')) !!} title="{!! config('app.name') !!}">
            <img src="{!! asset('images/logo/logo.png') !!}" alt="{!! config('app.name') !!}">
        </a>

    </div>

    @include('partials.menu')

</nav>

<!--/.Navbar-->
