@extends('app')

@section('js_css')

    <!-- js -->
    <script type="text/javascript" src="{{URL::asset("js/plugins/forms/styling/uniform.min.js")}}"></script>

    <script type="text/javascript" src="{{URL::asset("js/core/app.js")}}"></script>
    <script type="text/javascript" src="{{URL::asset("js/pages/login.js")}}"></script>

    <script type="text/javascript" src="{{URL::asset("js/plugins/ui/ripple.min.js")}}"></script>
    <!-- js -->

@endsection

@section('body')
    <body class="login-container">

    <!-- Main navbar -->
    @yield('navbar')
    <!-- /main navbar -->


    <!-- Page container -->
    @yield('content')
    <!-- /page container -->


    </body>
@endsection