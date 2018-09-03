@extends('auth.index')

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

                <div class="content">



                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                                <h5 class="content-group">Password recovery <small class="display-block">We'll send you instructions in email</small></h5>
                            </div>

                            @if (session('status'))
                                <div class="alert bg-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="Your email">
                                <div class="form-control-feedback">
                                    <i class="icon-mail5 text-muted"></i>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn bg-pink-400 btn-block">Reset password <i class="icon-arrow-right14 position-right"></i></button>
                        </div>
                    </form>

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