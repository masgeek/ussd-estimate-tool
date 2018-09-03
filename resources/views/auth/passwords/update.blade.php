@extends('auth.index')
<?php
//dd($token)
?>
@section('navbar')
    @component('components.navbar.auth')@endcomponent
@endsection

@section('content')
    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                @if($user)
                    <div class="content">

                        <form role="form" method="POST"
                              action="{{ route('account.activate', ['token' => $token,]) }}">
                            {{ csrf_field() }}

                            <div class="panel panel-body login-form">
                                <div class="text-center">
                                    <div class="icon-object border-slate-300 text-slate-300"><i
                                                class="icon-reading"></i>
                                    </div>
                                    <h5 class="content-group">To activate your account
                                        <small class="display-block">Update your password below</small>
                                    </h5>
                                </div>

                                <div class="form-group{{ $errors->has('one_time_password') ? ' has-error' : '' }} has-feedback has-feedback-left">
                                    <input id="one_time_password" type="password" class="form-control"
                                           name="one_time_password"
                                           placeholder="One time Password"
                                           value="{{ $errors->has('one_time_password') ? '' : old('one_time_password') }}"
                                           required>
                                    <div class="form-control-feedback">
                                        <i class="icon-circle-down2 text-muted"></i>
                                    </div>
                                    @if ($errors->has('one_time_password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('one_time_password') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback has-feedback-left">
                                    <input id="password" type="password" class="form-control" name="password"
                                           placeholder="New Password"
                                           required>
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback has-feedback-left">
                                    <input id="password_confirmation" type="password" class="form-control"
                                           name="password_confirmation"
                                           placeholder="Confirm new password"
                                           required>
                                    <div class="form-control-feedback">
                                        <i class="icon-lock2 text-muted"></i>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn bg-pink-400 btn-block">Update<i
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
                @else
                    <div class="content">

                        <div class="panel panel-body login-form">
                            <div class="text-center error">
                                <div class="icon-object border-slate-300 text-slate-300"><i class="icon-trash"></i>
                                </div>
                                <h5 class="content-group has-error">Error
                                    <small class="display-block help-block">The token provided is invalid</small>
                                </h5>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn bg-orange-400 btn-block">Sorry<i
                                            class="icon-eject position-right"></i></button>
                            </div>

                        </div>
                        <!-- /simple login form -->

                        <!-- Footer -->
                    @component('components.footer')@endcomponent
                    <!-- /footer -->
                        <!-- content -->
                    </div>
            @endif
            <!-- Main content -->
            </div>
            <!-- Page content -->
        </div>
        <!-- Page container -->
    </div>

@endsection