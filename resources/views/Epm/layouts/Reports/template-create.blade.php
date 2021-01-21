<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/generate/report/template')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Report Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="ie Monthly Reporting">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="key_actors">
                <label>Select Report Target Group</label>
                <multiselect name="target_groups" :options="admins" v-model="selectedGroup"
                             placeholder="Search" label="name" track-by="id"
                             :searchable="true" :close-on-select="true"
                             multiple>
                </multiselect>
                <input type="hidden" name="target_groups[]" v-for="admin in selectedGroup"  :value="admin.id">
                <span class="text-danger">{{$errors->first('target_groups')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="report_user_info">
                <label>Required Personal Information</label>
                <multiselect :options="infos" v-model="selectedInfo"
                             placeholder="Select Required info"
                             :searchable="true" :close-on-select="false"
                             multiple>
                </multiselect>
                <input type="hidden" name="required_fields[]" v-for="info in selectedInfo"  :value="info">
                <span class="text-danger">{{$errors->first('trainers')}}</span>
            </div>
        </div>
{{--        <div class="col-sm-12">--}}
{{--            <div class="form-group">--}}
{{--                <label>Required Information</label>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-12 reportUserInfo">--}}
{{--            <div class="form-group">--}}
{{--                <input type="text" class="form-control" name="required_fields[]" value="{{old('name')}}" placeholder="ie Reported by Name, role">--}}
{{--                <span class="text-danger">{{$errors->first('required_fields')}}</span>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-sm-12">--}}
{{--            <div class="form-group">--}}
{{--                <a href="#!" style="color: #7E858E;" id="addNewField"><span><i class="fa fa-plus"></i></span> Add Another Field</a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-sm-12">
            <div class="form-group">
                <label>Activity Report Questions</label>
            </div>
        </div>
        <div class="col-sm-12 addReportQuestion">
            <div class="form-group">
                <input type="text" name="questions[]" class="form-control" placeholder="ie No of Youths who attended the Training">
                <span class="text-danger">{{$errors->first('questions')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <a href="#!" style="color: #7E858E;" id="addNewQuestion"><span><i class="fa fa-plus"></i></span> Add Another Question</a>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Create Template</button>
            </div>
        </div>
    </div>
</form>
