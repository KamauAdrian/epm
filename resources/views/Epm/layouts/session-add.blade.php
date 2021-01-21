<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/session')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>SESSION NAME</label>
                <input type="text" name="name" class="form-control" placeholder="Luke S">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>SESSION DATE</label>
                <input type="date" name="date" class="form-control">
                <span class="text-danger">{{$errors->first('date')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>START TIME</label>
                <input type="time" name="start_time" class="form-control">
                <span class="text-danger">{{$errors->first('start_time')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>END TIME</label>
                <input type="time" name="end_time" class="form-control">
                <span class="text-danger">{{$errors->first('end_time')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>INSTITUTION</label>
                <input type="text" name="institution" class="form-control">
                <span class="text-danger">{{$errors->first('institution')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>TOWN</label>
                <input type="text" id="location" name="location" class="form-control">
                <input type="hidden" name="location_lat_long" id="location_lat_long">
                <span class="text-danger">{{$errors->first('town')}}</span>
            </div>
        </div>
        @if($trainers!='')
            <div class="col-sm-12">
                <div class="form-group" id="trainers">
                    <label>SELECT TRAINERS</label>
                    <multiselect :options="trainers" v-model="selectedTrainer"
                                 placeholder="Search" label="name" track-by="id"
                                 :searchable="true" :close-on-select="true"
                                 multiple>
                    </multiselect>
                    <input type="hidden" name="trainers[]" v-for="trainer in selectedTrainer"  :value="trainer.id">
                    <span class="text-danger">{{$errors->first('trainers')}}</span>
                </div>
            </div>
        @endif
        <div class="col-sm-12">
            <div class="form-group" id="session_type">
                <label>SESSION TYPE</label>
                <multiselect :options="type" v-model="selectedType"
                             placeholder="Search"
                             :searchable="true" :close-on-select="true">
                </multiselect>
                <input type="hidden" name="type" :value="selectedType">
                <span class="text-danger">{{$errors->first('type')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>ABOUT SESSION</label>
                <textarea name="about" class="form-control" placeholder="Short Description" cols="30" rows="5"></textarea>
                <span class="text-danger">{{$errors->first('about')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <a href="#!">
                    <button type="button" class="btn btn-outline-info">Generate Google Meet Link</button>
                </a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary">Add Session</button>
            </div>
        </div>
    </div>
</form>
