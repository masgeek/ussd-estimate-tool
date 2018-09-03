@extends('auth.index')

@section('navbar')
    @component('components.navbar.auth')@endcomponent
@endsection

@section('content')
    <div class="page-container">
        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">

                    <!-- Error title -->
                    <div class="text-center content-group">
                        <h1 class="error-title">404</h1>
                        <h5>Oops, an error has occurred. Page not found!</h5>
                    </div>
                    <!-- /error title -->


                    <!-- Error content -->
                    <div class="row">
                        <div class="col-lg-4 col-lg-offset-4 col-sm-6 col-sm-offset-3">
                            <form action="#" class="main-search panel panel-body">


                                <div class="text-center">
                                    <a href="{{url('/dashboard')}}" class="btn bg-pink-400"><i class="icon-circle-left2 position-left"></i> Back to dashboard</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /error wrapper -->
                    <!-- Footer -->
                   @component('components.footer')@endcomponent
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->
    </div>
@endsection