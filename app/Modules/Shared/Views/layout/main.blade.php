<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('sharedView::layout.partials.head')
        @include('sharedView::layout.partials.nav')
    </head>
    <body>
        @yield('content') @include('sharedView::layout.partials.footer')
        @include('sharedView::layout.partials.footer-scripts')
    </body>
</html>
