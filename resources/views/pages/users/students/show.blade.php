@extends('pages.index')

<?php
//Placeholder data
//Navigation

$menus['data']['Users']['data'][0]['active'] = true;
$navs = json_decode(json_encode(array_values($menus['data'])));

?>

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

@section('navbar')
    @component('components.navbar.navbar')
    @endcomponent
@endsection

@section('sidebar')
    @component('components.sidebar.sidebar', ['navs'=>$navs])
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <!-- Details -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Students</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                       {{-- Accountants - Exam officers - Teachers--}}
                    </div>
                    <table class="table datatable-responsive">
                        <thead>
                        <tr>
                            <th class="">Name</th>
                            <th>Adm No</th>
                            <th>Gender</th>
                            <th>Class</th>
                            <th>Stream</th>
                            <th class="text-center">Actions</th>
                            <th class="hidden"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $std)
                            <tr>
                                <td class="">{{$std->user->name}}</td>
                                <td>{{$std->adm_no}}</td>
                                <td>{{$std->gender}}</td>
                                <td>{{$std->class}}</td>
                                <td>{{$std->stream}}</td>
                                <td class="text-center">
                                    <ul class="icons-list">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li><a href="#"><i class="icon-eye-blocked2 text-success"></i> Coming</a></li>
                                                <li class="divider"></li>
                                                <li><a href="#"><i class="icon-finish text-danger"></i>Soon</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </td>
                                <td class="hidden"></td>
                            </tr>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2 hidden-xs hidden-sm disabled">
                <!-- Sidebar Filter -->
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <div class="panel-title text-semibold">
                            <i class="icon-search4 text-size-base position-left"></i>
                            Filter
                        </div>
                    </div>

                    <div class="panel-body">
                        <form action="#">
                            <div class="form-group">
                                <div class="has-feedback has-feedback-left">
                                    <input type="search"  disabled class="form-control" placeholder="Name or keywords">
                                    <div class="form-control-feedback">
                                        <i class="icon-reading text-size-large text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="has-feedback has-feedback-left">
                                    <input type="search" disabled class="form-control" placeholder="Location">
                                    <div class="form-control-feedback">
                                        <i class="icon-pin-alt text-size-large text-muted"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="checkbox">
                                    <label class="display-block">
                                        <input type="checkbox"  disabled class="styled">
                                        Primary School
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="display-block">
                                        <input type="checkbox"  disabled class="styled">
                                        High School

                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="display-block">
                                        <input type="checkbox" disabled  class="styled">
                                        College
                                    </label>
                                </div>
                            </div>

                            <button type="submit" disabled class="btn bg-blue btn-block">
                                <i class="icon-search4 text-size-base position-left"></i>
                                Filter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <<!-- Bottom right menu -->

        <!-- Footer -->
        @component('components.footer')@endcomponent

    </div>

@endsection