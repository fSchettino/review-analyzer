<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.partials.head')
        @include('layout.partials.nav')
    </head>
    <body>
        @yield('content') @include('layout.partials.footer')
        @include('layout.partials.footer-scripts')
    </body>
</html>
