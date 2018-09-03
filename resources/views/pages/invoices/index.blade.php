@extends('pages.index')

<?php
//Placeholder data
//Navigation
//Placeholder data
//Navigation
$menus['data']['invoices']['active'] = true;
$navs = json_decode(json_encode(array_values($menus['data'])));
?>

@section('js_css')
    <script type="text/javascript" src="{{URL::asset('js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/ripple.min.js')}}"></script>
    <!-- /theme JS files -->
@endsection

@section('navbar')
    @component('components.navbar.navbar')
    @endcomponent
@endsection

@section('sidebar')
    @component('components.sidebar.sidebar', ['navs'=>$navs,])
    @endcomponent
@endsection


@section('content')
    @include('components.coming_soon')
@endsection