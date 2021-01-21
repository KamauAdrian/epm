<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/team/cms/members/team_id='.$team->id)}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div team_id="{{$team->id}}" class="form-group" id="cms_new">
{{--            <div class="form-group" id="cms">--}}
                <label>Choose Team Member</label>
                <testkit name="cms" v-model="selectedCm" :options="cms"
                             placeholder="Search" label="name" track-by="id"
                             :searchable="false" :close-on-select="true" multiple>
                </testkit>
                <input type="hidden" v-for="member in selectedCm" name="cm_team_member_s_id[]" :value="member.id">
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row justify-content-between">
            <div class="col-auto text-right">
                <button type="submit" class="btn btn-primary btn-block mb-3">Add Member(s)</button>
            </div>
        </div>
    </div>
</form>
