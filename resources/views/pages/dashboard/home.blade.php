@extends('pages.index')

    <?php
        //Placeholder data
        //Navigation

        $menus['data']['dashboard']['active'] = true;
        $navs = json_decode(json_encode(array_values($menus['data'])));
        //user
        $user = json_decode("{\"id\":1,\"name\":\"Kenn Kenboi\",\"email\":\"kenboi@yahoo.com\"}");
        //school
        $school = json_decode("{\"id\":1,\"name\":\"Kagaki School\",\"email\":\"kenboi@yahoo.com\"}");
        //breadcrumbs
        $breadcrumb = json_decode("[{\"url\":\"/\",\"title\":\"Home\"},{\"url\":\"/\",\"title\":\"Dashboard\"}]");
    ?>

@section('js_css')
    @component('pages.dashboard.js_css')
    @endcomponent
@endsection

@section('navbar')
    @component('components.navbar.navbar')
    @endcomponent
@endsection

@section('sidebar')

    @component('components.sidebar.sidebar', ['navs'=>$navs,'user'=>$user,'school'=>$school])
    @endcomponent

@endsection

@section('header')

@endsection

@section('content')
    @include('pages.dashboard.content')
@endsection