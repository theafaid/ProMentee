@include('layouts._header')
<body class="">
<div class="page" id="promentee">
    <div class="flex-fill">
        @include('layouts._nav')
        <div class="my-3 my-md-5">
            @yield('content')
        </div>
    </div>
    @include('layouts._footer')
</div>
<script src="/js/lang.js"></script>
<script src="{{asset('js/app.js')}}"></script>
@stack('js')
</body>
</html>
