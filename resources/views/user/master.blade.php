<!DOCTYPE html>
<html lang="en">
    <head>
        @include('user.share.head')
        @yield('head')
    </head>
    <body>
        @include('user.share.menu')

        <!-- Section-->
        <section class="py-5">
            @yield('content')
        </section>
        <!-- Footer-->
        @include('user.share.foot')
        <!-- Bootstrap core JS-->
        @include('user.share.js')
        @yield('js')

    </body>
</html>
