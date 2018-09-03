<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback has-feedback-left">
    <label>{{$label}}</label>
    <textarea  name="{{$name}}"
               required rows="3" cols="3" class="form-control"
              placeholder="{{$placeholder}}">{{ old($name) }}</textarea>
    @if ($errors->has($name))
        <span class="help-block">
           <strong>{{ $errors->first($name) }}</strong>
       </span>
    @endif
</div>