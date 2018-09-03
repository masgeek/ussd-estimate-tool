<!-- Content area -->
<div class="content">

    <!-- Main charts -->
    <div class="row hidden">
        <div class="col-lg-7">
            @component('components.charts.line')@endcomponent
        </div>

        <div class="col-lg-5">

            <!-- Sales stats -->
        @component('components.charts.graph')@endcomponent
        <!-- /sales stats -->

        </div>
    </div>
    <!-- /main charts -->


    <!-- Dashboard content -->
    <div class="row">
        <div class="col-lg-8">

        {{--@component('pages.dashboard.marketting')@endcomponent--}}


        <!-- population stats boxes -->
        @include('pages.dashboard.population')
        <!-- /population stats boxes -->


            <!-- Events -->
        @include('pages.dashboard.events')
        <!-- Events -->


        </div>

        <div class="col-lg-4">


        @component('pages.dashboard.sms_counter')@endcomponent

        <!-- Sms counters -->


            <!-- My invoices -->
        @component('pages.dashboard.my_invoices')@endcomponent
        <!-- My invoices -->


        </div>
    </div>
    <!-- /dashboard content -->


    <!-- Footer -->
@component('components.footer')@endcomponent
<!-- /footer -->

</div>
<!-- /content area -->