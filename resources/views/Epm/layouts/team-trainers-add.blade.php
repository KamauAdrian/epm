<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/team/trainers')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Team Name</label>
                <input type="text" name="name" class="form-control" placeholder="Luke S">
            </div>
        </div>
        @if($trainers!='')
            <div class="col-sm-12">
                <div class="form-group" id="trainers">
                    <label>Team Leader</label>
                    <multiselect name="team_leader" v-model="selectedTrainer" :options="trainers"
                                 placeholder="Search" label="name" track-by="id"
                                 :searchable="true" :close-on-select="true">
                    </multiselect>
                    <input type="hidden" v-for="trainer in selectedTrainer" name="team_leader_id" :value="selectedTrainer.id">
                    <input type="hidden" v-for="trainer in selectedTrainer" name="team_leader_name" :value="selectedTrainer.name">
                </div>
            </div>
        @endif
        <div class="col-sm-12">
            <div class="form-group">
                <label>Team Description</label>
                <textarea name="about" class="form-control" placeholder="Short Team Description" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Create Team</button>
            </div>
        </div>
    </div>
</form>
