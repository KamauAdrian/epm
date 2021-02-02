<?php
$auth_admin = auth()->user();
?>
<form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/session/'.$session->id.'/save/trainees/')}}">
    @csrf
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{old('name')}}">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group" id="gender">
                <label>Gender</label>
                <gender name="gender" v-model="selectedGender" :options="gender"
                        placeholder="Select Gender"
                        :searchable="true" :close-on-select="true">
                </gender>
                <input type="hidden" name="gender" :value="selectedGender">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="Ex. luke@jacademy.org" value="{{old('email')}}">
                <span class="text-danger">{{$errors->first('email')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" placeholder="0728909090" value="{{old('phone')}}">
                <span class="text-danger">{{$errors->first('phone')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>ID Number</label>
                <input type="text" name="id_number" class="form-control" placeholder="36748285" value="{{old('id_number')}}">
                <span class="text-danger">{{$errors->first('id_number')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label>Age</label>
                <input type="number" name="age" class="form-control" placeholder="22" value="{{old('age')}}">
                <span class="text-danger">{{$errors->first('age')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="computer_literacy">
                <label>Level of Computer Literacy</label>
                <level name="level_of_computer_literacy" v-model="selectedLevel" :options="levels"
                          placeholder="Search"
                          :searchable="true" :close-on-select="true">
                </level>
                {{--                <input type="hidden" v-for="cm in selectedCm" name="team_leader_id" :value="selectedCm.id">--}}
                <input type="hidden" name="level_of_computer_literacy" :value="selectedLevel">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group" id="education">
                <label>Level of Education</label>
                <level name="level_of_education" v-model="selectedLevel" :options="levels"
                       placeholder="Search"
                       :searchable="true" :close-on-select="true">
                </level>
                {{--                <input type="hidden" v-for="cm in selectedCm" name="team_leader_id" :value="selectedCm.id">--}}
                <input type="hidden" name="level_of_education" :value="selectedLevel">
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <label>Field Of Study</label>
                <input type="text" name="field_of_study" class="form-control" placeholder="Computer Science" value="{{old('field_of_study')}}">
                <span class="text-danger">{{$errors->first('field_of_study')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Interests</label>
                <textarea name="interests" class="form-control" placeholder="Interests" value="{{old('interests')}}" cols="30" rows="5"></textarea>
                <span class="text-danger">{{$errors->first('interests')}}</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row justify-content-between">
            <div class="col-auto text-right">
                <button type="submit" class="btn btn-primary btn-block mb-3">Add Trainee</button>
            </div>
        </div>
    </div>
</form>
