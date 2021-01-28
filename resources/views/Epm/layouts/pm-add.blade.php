<form class="my-5" method="post" action="{{url('/save-pm')}}" enctype="multipart/form-data">
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
            <div class="form-group">
                <label>Employee Number</label>
                <input type="text" name="employee_number" class="form-control" placeholder="Luke S" value="{{old('employee_number')}}">
                <span class="text-danger">{{$errors->first('employee_number')}}</span>
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
                <input type="text" name="phone" class="form-control" placeholder="0728909090" value="{{old('phone')}}">
                <span class="text-danger">{{$errors->first('phone')}}</span>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group" id="county">
                <label>County</label>
                <county v-model="selectedCounty" :options="counties" name="county"
                        placeholder="Select Gender"
                        :searchable="true" :close-on-select="true">
                </county>
                <span class="text-danger">{{$errors->first('county')}}</span>
                <input type="hidden" name="county" :value="selectedCounty">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group" id="gender">
                <label>Gender</label>
                <gender name="gender" v-model="selectedGender" :options="gender"
                             placeholder="Select Gender"
                             :searchable="true" :close-on-select="true">
                </gender>
                <span class="text-danger">{{$errors->first('gender')}}</span>
                <input type="hidden" name="gender" :value="selectedGender">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group" id="department">
                <label>Department</label>
                <department name="department" v-model="selectedDepartment" :options="departments"
                             placeholder="Select Department"
                             :searchable="true" :close-on-select="true">
                </department>
                <span class="text-danger">{{$errors->first('department')}}</span>
                <input type="hidden" name="department" :value="selectedDepartment">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Upload Profile Image</label>
                <input type="file" name="image" class="form-control">
                <span class="text-danger">{{$errors->first('image')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label>Add Bio</label>
                <textarea name="bio" class="form-control" placeholder="Bio" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Add PMO</button>
            </div>
        </div>
    </div>
</form>
