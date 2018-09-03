<form role="form" method="POST" action="{{ route($action) }}">
    {{ csrf_field() }}

    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-plus2"></i>
            </div>
            <h5 class="content-group">{{$title}}
                <small class="display-block">All fields are required</small>
            </h5>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                {{ $slot }}
                <div class="text-right">
                    <a href="{{route($back)}}"><button type="button" class="btn btn-link pull-left"><i class="icon-arrow-left52 position-left"></i>Go back</button></a>
                    <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-10"><b><i class="icon-plus3"></i></b>{{$btn_text}}</button>
                </div>
            </div>
        </div>

    </div>
</form>