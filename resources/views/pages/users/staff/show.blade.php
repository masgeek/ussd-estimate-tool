@extends('pages.index')

<?php
//Placeholder data
//Navigation

$menus['data']['Users']['data'][1]['active'] = true;
$navs = json_decode(json_encode(array_values($menus['data'])));
//school
$school = json_decode("{\"id\":1,\"name\":\"Kagaki School\",\"email\":\"kenboi@yahoo.com\"}");
//dd($staff->toArray());
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
    @component('components.sidebar.sidebar', ['navs'=>$navs,'school'=>$school])
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <!-- Details -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Members of staff</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="reload"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        Accountants - Exam officers - Teachers
                    </div>
                    <table class="table datatable-responsive">
                        <thead>
                        <tr>
                            <th class="">Name</th>
                            <th>Email address</th>
                            <th>Phone</th>
                            <th class="">Roles</th>
                            <th class="text-center hidden">Actions</th>
                            <th class="hidden"></th>
                            <th class="hidden"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($staff as $std)
                            <tr>
                                <td class="">{{$std->user->name}}</td>
                                <td>{{$std->user->email}}</td>
                                <td>{{$std->user->phone}}</td>
                                <td class="">
                                    @foreach($std->user->roles as $role)
                                        {{$role->display_name}}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </td>
                                <td class="text-center hidden">Actions</td>
                                <td class="hidden"></td>
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
            <ul class="fab-menu fab-menu-fixed fab-menu-bottom-right">
                <li>
                    <a href="{{route('staff.create')}}" class="fab-menu-btn btn bg-teal-400 btn-float btn-rounded btn-icon">
                        <i class="fab-icon-open icon-plus2"></i>
                        <i class="fab-icon-close icon-cross2"></i>
                    </a>
                </li>
            </ul>
        </div>


        <<!-- Bottom right menu -->

        <!-- Footer -->
        @component('components.footer')@endcomponent

    </div>

@endsection