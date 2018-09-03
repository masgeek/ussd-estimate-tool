<tr>
    <td class="text-center">
        <h6 class="no-margin">{{\Carbon\Carbon::parse($data['created_at'])->month}} <small class="display-block text-size-small no-margin">{{\Carbon\Carbon::parse($data['created_at'])->year}}</small></h6>
    </td>
    <td>
        <div class="media-left media-middle">
            <a href="#" class="btn {{randomColor()}} btn-rounded btn-icon btn-xs">
                <span class="letter-icon">{{strtoupper(substr($data['category'],0,1))}}</span>
            </a>
        </div>

        <div class="media-right">
            <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">{{$data['name']}}</a>
            <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> {{$data['type']}}</div>
        </div>
    </td>
    <td>
        <a href="https://www.google.com/maps/search/?api=1&query={{str_replace(' ','+',$data['location'])}}" target="_blank" class="text-default display-inline-block">
            <span class="text-semibold">{{$data['address']}}</span>
            <div class="text-muted text-indigo text-size-small"><span class="icon-location3 small text-indigo border-blue position-left"></span> {{$data['location']}}</div>
        </a>
    </td>
    <td class="text-center">
        <ul class="icons-list">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-eye-blocked2 text-success"></i> Coming</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-finish text-danger"></i>Soon</a></li>
                </ul>
            </li>
        </ul>
    </td>
    <td class="hidden"></td>
    <td class="hidden"></td>
    <td class="hidden"></td>
</tr>
