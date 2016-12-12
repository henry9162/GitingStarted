@include('partials.head')
    <body>
        @include('partials.nav')

         <div class="container">
            @include('partials.messages')

            @yield('content')
         </div>

         @include('partials.footer')

        @include('partials.javascript')
        @yield('scripts')
    </body>
</html>