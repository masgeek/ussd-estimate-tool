<div class="row">
    <div class="col-lg-4">

        <!-- Boys -->
        <div class="panel bg-teal-400">
            <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-teal-800">
                         @if($students['total']>0)
                            {{round(($students['male']*100/$students['total']),2)}}
                        @else
                            0
                        @endif
                        %
                    </span>
                </div>

                <h3 class="no-margin">{{$students['male']}}</h3>
                Boys population
                <div class="text-muted text-size-small">avg of
                    @if($students['classes']>0)
                        {{ceil($students['male']/$students['classes'])}}
                    @else
                        0
                    @endif
                    per
                    class
                </div>
            </div>

            <div class="container-fluid">
                <div id="total-boys"></div>
            </div>
        </div>
        <!-- Boys -->

    </div>

    <div class="col-lg-4">

        <!-- Girls -->
        <div class="panel bg-pink-400">
            <div class="panel-body">
                <div class="heading-elements">
                    <span class="heading-text badge bg-pink-800">
                        @if($students['total']>0)
                            {{round(($students['female']*100/$students['total']),2)}}
                        @else
                            0
                        @endif
                        %
                    </span>
                </div>

                <h3 class="no-margin">{{$students['female']}}</h3>
                Girls population
                <div class="text-muted text-size-small">avg of
                    @if($students['classes']>0)
                        {{ceil($students['female']/$students['classes'])}}
                    @else
                        0
                    @endif
                    per class
                </div>
            </div>

            <div class="container-fluid">
                <div id="total-girls"></div>
            </div>
        </div>
        <!-- Girls -->

    </div>

    <div class="col-lg-4">
        <!-- Staff -->
        <div class="panel bg-blue-400">
            <div class="panel-body">
                <div class="heading-elements">
                </div>

                <h3 class="no-margin">{{$staff}}</h3>
                Teaching and support
                <div class="text-muted text-size-small">staff</div>
            </div>

            <div class="container-fluid">
                <div id="all-staff"></div>
            </div>
        </div>
        <!-- Staff -->
    </div>

</div>