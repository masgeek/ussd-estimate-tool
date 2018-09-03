@extends('auth.index')
<?php
//dd($token)
?>
@section('navbar')
    @component('components.navbar.navbar')@endcomponent
@endsection

@section('content')
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">
                <div class="content">

                    <form role="form" method="POST"
                          action="{{ route('activation.account')}}">
                        {{ csrf_field() }}

                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-slate-300 text-slate-300"><i
                                            class="icon-lock2"></i>
                                </div>
                                <h5 class="content-group text-teal-600">Hello! {{explode(" ", Auth::user()->name)[0]}}
                                    <small class="display-block">
                                        Account activation
                                    </small>
                                </h5>
                            </div>
                            <div class="text-grey-600">
                                <p>
                                    We sent you an email with instructions on how to activate your account.
                                <p>
                                    In case you did not receive it, click the button below and we'll resend it right
                                    away.
                                </p>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-pink-400 btn-block">Resend<i
                                            class="icon-circle-right2 position-right"></i></button>
                            </div>

                        </div>
                    </form>
                    <!-- /simple login form -->


                    <!-- Footer -->
                @component('components.footer')@endcomponent
                <!-- /footer -->
                    <!-- content -->
                </div>
                <!-- Main content -->
            </div>
            <!-- Page content -->
        </div>
        <!-- Page container -->
    </div>

@endsection