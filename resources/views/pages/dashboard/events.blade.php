<!-- Events -->
<div class="panel panel-flat">
    <div class="panel-heading">
        <h6 class="panel-title text-pink-600 text-bold">Events and activities</h6>
        <div class="heading-elements">
            {{--<button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
            </button>--}}
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-xlg text-nowrap">
            <tbody>
            <tr class="hidden">
                <td class="col-md-4">
                    <div class="media-left media-middle">
                        <div id="tickets-status"></div>
                    </div>

                    <div class="media-left">
                        <h5 class="text-semibold no-margin">Next event</h5>
                        <span class="text-muted"><span class="status-mark border-success position-left"></span> <a
                                    href="#">Jun 16, 10:00 am</a> </span>
                    </div>
                </td>

                <td class="col-md-3">
                    <div class="media-left media-middle">
                        <a href="#"
                           class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i
                                    class="icon-alarm-add"></i></a>
                    </div>

                    <div class="media-left">
                        <h5 class="text-semibold no-margin">
                            12
                            <small class="display-block no-margin">All events</small>
                        </h5>
                    </div>
                </td>

                <td class="col-md-3">
                    <div class="media-left media-middle">
                        <a href="#"
                           class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-xs btn-icon"><i
                                    class="icon-spinner11"></i></a>
                    </div>

                    <div class="media-left">
                        <h5 class="text-semibold no-margin">
                            8
                            <small class="display-block no-margin">Upcoming</small>
                        </h5>
                    </div>
                </td>

                <td class="text-right col-md-2">
                    <!--<a href="#" class="btn bg-teal-400"><i class="icon-statistics position-left"></i> Report</a>-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="table-responsive">
        <table class="table text-nowrap">
            <thead>
            <tr>
                <th style="width: 50px">Created</th>
                <th style="width: 300px;">type</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                @component('components.event_row',['event'=>$event])
                @endcomponent
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Events -->