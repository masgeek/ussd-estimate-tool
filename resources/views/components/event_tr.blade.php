<tr>
    <td>{{$event->title}}</td>
    <td><span class="label label-default">{{$event->event_type}}</span></td>
    <td>{{\Carbon\Carbon::parse($event->event_date)->toFormattedDateString()}}</td>
    <td><span class="label label-success">{{\Carbon\Carbon::parse($event->event_date)->format('h:i A') }}</span></td>
    {{--<td>{{$event->description}}</td>--}}
    <td class="text-center">
        <ul class="icons-list">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-menu9"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-database-edit2"></i>edit</a></li>
                    <li><a href="#"><i class="icon-trash"></i>delete</a></li>
                </ul>
            </li>
        </ul>
    </td>
    <td class="hidden"></td>
    <td class="hidden"></td>
</tr>