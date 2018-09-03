<!DOCTYPE html>
<!--suppress ALL -->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bunifu Schools - Admin Dashboard</title>

        <!-- Global stylesheets -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('css/core.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('css/components.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('css/colors.css')}}" rel="stylesheet" type="text/css">
        <!-- /global stylesheets -->

        <!-- Core JS files -->
        <script type="text/javascript" src="{{URL::asset('js/plugins/loaders/pace.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/core/libraries/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/core/libraries/bootstrap.min.js')}}"></script>
        <script type="text/javascript" src="{{URL::asset('js/plugins/loaders/blockui.min.js')}}"></script>
        <!-- /core JS files -->

        {{--Pnotify--}}

        @yield('js_css')
        <script type="text/javascript" src="{{URL::asset('js/plugins/notifications/pnotify.min.js')}}"></script>


    </head>

    @yield('body')
</html>
