<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/session/'.$session->id.'/save/trainers')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div session_id="{{$session->id}}" class="form-group" id="new_session_trainers">
                <label>Choose Trainer</label>
                <multiselect name="cms" v-model="selectedTrainer" :options="trainers"
                             placeholder="Search" label="name" track-by="id"
                             :searchable="true" :close-on-select="true" multiple>
                </multiselect>
                <input type="hidden" v-for="member in selectedTrainer" name="new_session_trainers_ids[]" :value="member.id">
                <input type="hidden" v-for="member in selectedTrainer" name="new_session_trainers_names[]" :value="member.name">
            </div>
        </div>
{{--        <input type="hidden" name="trainer_team_id" value="{{$team->id}}">--}}
    </div>
    <div class="form-group">
        <div class="row justify-content-between">
            <div class="col-auto text-right">
                <button type="submit" class="btn btn-primary btn-block mb-3">Add Trainer(s)</button>
            </div>
        </div>
    </div>
</form>
