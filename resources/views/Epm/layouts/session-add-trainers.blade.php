<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/session/'.$session->id.'/day/'.$trainingDay->id.'/save/trainers')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div day_id="{{$trainingDay->id}}" class="form-group" id="new_session_trainers">
                <label>Choose Trainer</label>
                <multiselect name="cms" v-model="selectedTrainer" :options="trainers"
                             placeholder="Search" label="name" track-by="id"
                             :searchable="true" :close-on-select="true" multiple>
                </multiselect>
                <input type="hidden" v-for="member in selectedTrainer" name="new_session_trainers_ids[]" :value="member.id">
                <input type="hidden" v-for="member in selectedTrainer" name="new_session_trainers_names[]" :value="member.name">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-info btn-block mb-3">Add Trainers</button>
            </div>
        </div>
{{--        <input type="hidden" name="trainer_team_id" value="{{$team->id}}">--}}
    </div>

</form>
