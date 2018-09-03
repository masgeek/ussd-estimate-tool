<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
    <input id="{{$id}}" type="password" class="form-control" name="{{$name}}"
           value="{{ old($name) }}" required
           autofocus placeholder="{{$placeholder}}">
    <div class="form-control-feedback">
        <i class="icon-key text-muted"></i>
    </div>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>