'<div class="col-md-12" style="display: none;" id="modal-task-id">'+response_task.id+'</div>'+
'<div class="col-md-12">'+
    '<div class="form-group">'+
        '<h6 class="text-center" onclick="openModalUpdateTaskName()">'+response_task.name+'</h6>'+
    '</div>'+
'</div>'+
'<div class="mt-4">'+
    '<div style="font-size: 12px" class="text-small text-muted">Due Date</div>'+
    '<div class="">'+
        '<span style="font-size: 12px" onclick="openModalUpdateDueDate()">'+due_date+'</span>'+
    '</div>'+
    '<div class="mt-2">'+
        '<div style="font-size: 12px" class="text-small text-muted">Assignees/Collaborators</div>'+
        '<div class="">'+
            '<span style="font-size: 12px">'+task_assignees+'</span>'+
            '<button type="button" class="btn btn-icon" onclick="openModalUpdateAssignee()">+</button>'+
        '</div>'+
    '</div>'+
'</div>'
