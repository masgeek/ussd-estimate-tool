<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }} has-feedback has-feedback-left">
    <label>{{$label}}</label>
    <div class="input-group">
        <span class="input-group-addon"><i class="{{$icon}}"></i></span>
        <input id="{{$id}}" name="{{$name}}" type="text" class="form-control pickatime"
               placeholder="{{$placeholder}}" value="{{ old($name) }}" required>
    </div>

    @if ($errors->has($name))
        <span class="help-block text-danger">
           <strong>{{ $errors->first($name) }}</strong>
       </span>
    @endif

</div>