<li @if($nav->active)class="active" @endif>
    <a href="{{url($menus['config']['base_url'].$nav->url)}}" >
        <i class="{{$nav->icon}}"></i>
        <span>{{$nav->title}}</span>
    </a>

    @if(sizeof($nav->data)>0)
        <ul>
            @foreach($nav->data as $data)
                <li @if($data->active)class="active" @endif><a href="{{url($menus['config']['base_url'].$data->url)}}">{{$data->title}}</a></li>
            @endforeach
        </ul>
    @endif

</li>

