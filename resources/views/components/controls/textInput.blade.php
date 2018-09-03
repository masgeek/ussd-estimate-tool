<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }} has-feedback has-feedback-left">
    <label>{{$label}}</label>
    <input id="{{$id}}" type="text" class="form-control" name="{{$name}}"
           value="{{ old($name) }}" required
           autofocus placeholder="{{$placeholder}}">
    <div class="form-control-feedback">
        <i class="{{$icon}} text-muted"></i>
    </div>
    @if ($errors->has($name))
        <span class="help-block text-danger">
           <strong>{{ $errors->first($name) }}</strong>
       </span>
    @endif
</div>