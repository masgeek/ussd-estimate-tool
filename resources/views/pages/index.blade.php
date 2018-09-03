@extends('app')
@section('body')
    <body>

    <!-- Main navbar -->
    {{--yield page nav bar here--}}
    @yield('navbar')
    <!-- /main navbar -->


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main sidebar -->
        {{--Yield side bar here--}}
        @yield('sidebar')
        <!-- /main sidebar -->


            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Page header -->
            {{--Yield page header here--}}
            @yield('header')
            <!-- /page header -->


                <!-- Content area -->
            {{--Yield page content here--}}
            @yield('content')
            <!-- /content area -->

            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->
    @yield('js')
    @if (Session::has('notifier.notice'))
        <script>
            $(function () {
                new PNotify({!! Session::get('notifier.notice') !!});
            })
        </script>
    @endif
    </body>
@endsection