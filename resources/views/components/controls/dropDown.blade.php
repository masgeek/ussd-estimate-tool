<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }} has-feedback has-feedback-left">
    <label>{{$label}}</label>
    <select name="{{$name}}" class="select">
        <option value="">--choose--</option>
        @foreach($data as $item)
            <option {{ old($name)===$item['name'] ? "selected":"" }} value="{{$item['name']}}">{{$item['value']}}</option>
        @endforeach
    </select>
    @if ($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
         </span>
    @endif
</div>
