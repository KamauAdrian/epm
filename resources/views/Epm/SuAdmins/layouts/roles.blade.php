<?php
$pm_role = \App\Models\Role::where('name','Project Manager')->first();
$cm_role = \App\Models\Role::where('name','Center Manager')->first();
$trainer_role = \App\Models\Role::where('name','Trainer')->first();
$mentor_role = \App\Models\Role::where('name','Mentor')->first();
?>
