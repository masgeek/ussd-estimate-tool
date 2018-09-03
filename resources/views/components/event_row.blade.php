<tr>
    <td class="text-center">
        <?php $date = explode(' ', \Carbon\Carbon::parse($event['created_at'])->diffForHumans(\Carbon\Carbon::now(), true))?>
        <h6 class="no-margin">{{$date[0]}} <small class="display-block text-size-small no-margin">{{$date[1]}} ago</small></h6>
    </td>
    <td>
        <div class="media-left media-middle">
            <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs">
                <span class="letter-icon"></span>
            </a>
        </div>

        <div class="media-body">
            <a href="#" class="display-inline-block text-default text-semibold letter-icon-title">{{$event['event_type']}}</a>
            <div class="text-muted text-size-small"><span class="status-mark border-blue position-left"></span> {{\Carbon\Carbon::parse($event['event_date'])->format('l jS \\, F')}}</div>
        </div>
    </td>
    <td>
        <a href="#" class="text-default display-inline-block">
            <span class="text-semibold">{{$event['title']}}</span>
            <span class="display-block text-muted">{{$event['description']}}</span>
        </a>
    </td>
</tr>