@extends('pages.index')

    <?php
        //Placeholder data
        //Navigation

        $menus['data']['clients']['active'] = true;
        $navs = json_decode(json_encode(array_values($menus['data'])));
        //user
        $user = json_decode("{\"id\":1,\"name\":\"Kenn Kenboi\",\"email\":\"kenboi@yahoo.com\"}");
        //school
        $school = json_decode("{\"id\":1,\"name\":\"Kagaki School\",\"email\":\"kenboi@yahoo.com\"}");
        //breadcrumbs
        $breadcrumb = json_decode("[{\"url\":\"/\",\"title\":\"Home\"},{\"url\":\"/\",\"title\":\"Dashboard\"}]");
    ?>

@section('js_css')

@section('js_css')

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/selects/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/plugins/tables/datatables/extensions/responsive.min.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/core/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/pages/form_layouts.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/pages/datatables_responsive.js')}}"></script>

    <script type="text/javascript" src="{{URL::asset('js/plugins/ui/ripple.min.js')}}"></script>

    <!-- /theme JS files -->


@endsection
@endsection

@section('navbar')
    @component('components.navbar.navbar')
    @endcomponent
@endsection

@section('sidebar')
    @component('components.sidebar.sidebar', ['navs'=>$navs,'school'=>$school])
    @endcomponent
@endsection

@section('header')
@endsection

@section('content')

    @component('pages.admin.clients.content', ['data'=>$data])
    @endcomponent

@endsection