

<div class="mt-4">
    <div style="font-size: 12px" class="text-small text-muted">Due Date</div>
    <div class="">
        @if($task->due_date)
            <span style="font-size: 12px"> {{$task->due_date}}</span>
        @else
            <div class=""><i class="fa fa-calendar"></i> No Due Date</div>
        @endif
    </div>
    <div class="mt-2">
        <div style="font-size: 12px" class="text-small text-muted">Assignees/Collaborators</div>
        @if($avatar_icon_name)
            @foreach($avatar_icon_name as $name)
                <span class="badge badge-pill badge-success p-2">{{$name}}</span>
            @endforeach
        @endif
        <a href="#!" title="Assign new Collaborators" class="btn btn-icon">
            <i class="feather icon-plus"></i>
        </a>
    </div>
</div>
