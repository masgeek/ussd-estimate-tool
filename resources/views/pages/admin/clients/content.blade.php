<div class="content">
    <div class="row">
        <div class="col-md-10">
            <!-- Details -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h5 class="panel-title">Clients/Schools</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="reload"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="panel-body">
                    View all onboarded clients
                </div>
                <table class="table datatable-responsive">
                    <thead>
                    <tr>
                        <th class="text-center">On Boarded</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th class="text-center hidden">Actions</th>
                        <th class=""></th>
                        <th class="hidden"></th>
                        <th class="hidden"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $datum)
                        @component('pages.admin.clients.row',['data'=>$datum])@endcomponent
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
                <a href="{{route('client.add')}}" class="fab-menu-btn btn bg-teal-400 btn-float btn-rounded btn-icon">
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

