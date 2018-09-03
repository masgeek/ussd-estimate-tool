@extends('pages.index')

<?php
//Placeholder data
//Navigation
//Placeholder data
//Navigation
$menus['data']['events']['data'][1]['active'] = true;
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
    @component('components.sidebar.sidebar', ['navs'=>$navs,])
    @endcomponent
@endsection

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">All events</h5>
                    </div>

                    <div class="panel-body">
                        View all new and upcoming events
                    </div>

                    <table class="table datatable-responsive">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Start time</th>
                            <th class="text-center hidden">Actions</th>
                            <th class="hidden"></th>
                            <th class="hidden"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $event)
                            @component('components.event_tr', ['event'=>$event, 'id'=>$loop->index+1])
                            @endcomponent
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
                    <a href="{{route('event.create')}}" class="fab-menu-btn btn bg-teal-400 btn-float btn-rounded btn-icon">
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