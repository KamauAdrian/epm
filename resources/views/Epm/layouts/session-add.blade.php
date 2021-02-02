<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/session')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>SESSION NAME</label>
                <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>SESSION DATE</label>
                <input type="date" name="date" class="form-control" value="{{old('date')}}">
                <span class="text-danger">{{$errors->first('date')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>START TIME</label>
                <input type="time" name="start_time" class="form-control" value="{{old('start_time')}}">
                <span class="text-danger">{{$errors->first('start_time')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>END TIME</label>
                <input type="time" name="end_time" class="form-control" value="{{old('end_time')}}">
                <span class="text-danger">{{$errors->first('end_time')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>SESSION MODE</label>
            </div>
            <div class="row">
                <div class="col-sm-12 ml-4">
                    <div class="form-group">
                        <input type="radio" name="mode" onclick="sessionModePhysical()" value="Physical"> Physical
                    </div>
                    <div class="form-group">
                        <input type="radio" name="mode" onclick="sessionModeVirtual()" value="Virtual"> Virtual
                    </div>
                </div>
            </div>
            <div class="form-group">
                <span class="text-danger">{{$errors->first('mode')}}</span>
            </div>
        </div>
        <div class="col-sm-12" id="sessionMode" style="display: none">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" id="county">
                        <label>County</label>
                        <county name="county" v-model="selectedCounty" :options="counties"
                                placeholder="Search"
                                :searchable="true" :close-on-select="true">
                        </county>
                        <input type="hidden" name="county" :value="selectedCounty">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>TOWN/LOCATION</label>
                        <input type="text" id="location" name="location" class="form-control" value="{{old('location')}}">
                        <input type="hidden" name="location_lat_long" id="location_lat_long">
                        <span class="text-danger">{{$errors->first('location')}}</span>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>INSTITUTION</label>
                        <input type="text" name="institution" class="form-control" placeholder="Institution" value="{{old('institution')}}">
                        <span class="text-danger">{{$errors->first('institution')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="session_type" style="display: none">
                <label>SESSION TYPE</label>
                <multiselect :options="types" v-model="selectedType"
                             placeholder="Select Session Type"
                             :searchable="true" :close-on-select="true">
                </multiselect>
                <input type="hidden" name="type" :value="selectedType">
                <span class="text-danger">{{$errors->first('type')}}</span>
            </div>
        </div>
        @if($trainers!='')
            <div class="col-sm-12">
                <div class="form-group" id="trainers">
                    <label>SESSION TRAINERS</label>
                    <multiselect :options="trainers" v-model="selectedTrainer"
                                 placeholder="Select Session Trainers" label="name" track-by="id"
                                 :searchable="true" :close-on-select="true"
                                 multiple>
                    </multiselect>
                    <input type="hidden" name="trainers[]" v-for="trainer in selectedTrainer"  :value="trainer.id">
                    <span class="text-danger">{{$errors->first('trainers[]')}}</span>
                </div>
            </div>
        @endif
        <div class="col-sm-12">
            <div class="form-group" id="category">
                <label>SESSION CATEGORY</label>
                <category v-model="selectedCategory" :options="categories"
                          placeholder="Select The Session Category"
                          :searchable="true" :close-on-select="true">
                </category>
                <input type="hidden" name="category" :value="selectedCategory">
                <span class="text-danger">{{$errors->first('category')}}</span>
            </div>
        </div>
        @if($classes!='')
            <div class="col-sm-12">
                <div class="form-group" id="sessionClasses">
                    <label>SESSION TARGET CLASS</label>
                    <multiselect :options="session_classes" v-model="selectedSessionClass"
                                 placeholder="Select Session Target Class" label="name" track-by="id"
                                 :searchable="true" :close-on-select="true" multiple>
                    </multiselect>
                    <input type="hidden" name="s_classes[]" v-for="sclass in selectedSessionClass"  :value="sclass.id">
                </div>
            </div>
        @endif
        <div class="col-sm-12">
            <div class="form-group">
                <label>SESSION ABOUT</label>
                <textarea name="about" class="form-control" placeholder="Short Session Description" cols="30" rows="5">{{old('about')}}</textarea>
                <span class="text-danger">{{$errors->first('about')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group" id="sessionLink" style="display: none">
                        <a href="#!">
                            <button type="button" id="sessionGoogleMeetLink" onclick="generateSessionLink()" class="btn btn-outline-info">Generate Google Meet Link</button>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary float-right">Add Session</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
