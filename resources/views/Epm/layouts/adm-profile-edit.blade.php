@inject('user','App\Models\User')
<?php
$admin_user = $user::find($admin->id);
?>

<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12 mb-4 text-center">
            <h1 class="d-inline-block font-weight-normal mb-0">Edit {{$admin_user->name}} Profile</h1>
        </div>
    </div>
    <form action="{{url('/update/adm/'.$admin_user->id.'/profile/role_id='.$admin_user->role->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                @if($admin_user->image)
                    <div class="form-group">
                        @if($admin_user->role->name == 'Project Manager')
                            <figure class="figure">
                                <img src="{{url('ProjectManagers/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                            </figure>
                        @elseif($admin_user->role->name == 'Center Manager')
                            <figure class="figure">
                                <img src="{{url('CenterManagers/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                            </figure>
                        @elseif($admin_user->role->name == 'Trainer')
                            <figure class="figure">
                                <img src="{{url('Trainers/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                            </figure>
                        @elseif($admin_user->role->name == 'Mentor')
                            <figure class="figure">
                                <img src="{{url('Mentors/images',$admin_user->image)}}" class="figure-img img-fluid rounded" alt="...">
                            </figure>
                        @endif
                        <label>Change Profile Photo</label>
                        <input type="file" name="image" value="{{$admin_user->image}}" class="form-control">
                    </div>
                @else
                    @if($admin_user->gender == 'Male')
                        <div class="form-group">
                            <figure class="figure">
                                <img src="{{url('assets/images/male.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
                                {{--                            <figcaption class="figure-caption text-center mt-2">Upload photo</figcaption>--}}
                            </figure>
                            <label>Upload Profile Photo</label>
                            <input type="file" name="image" value="{{$admin_user->image}}" class="form-control">
                        </div>
                    @else
                        <div class="form-group">
                            <figure class="figure">
                                <img src="{{url('assets/images/female.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
                                {{--                            <figcaption class="figure-caption text-center mt-2">Upload photo</figcaption>--}}
                            </figure>
                            <label>Upload Profile Photo</label>
                            <input type="file" name="image" value="{{$admin_user->image}}" class="form-control">
                        </div>
                    @endif
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{$admin_user->name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{$admin_user->email}}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="{{$admin_user->phone}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="county">
                            <label>County</label>
                            <multiselect name="county" v-model="selectedCounty" :options="counties"
                                         placeholder="Select County"
                                         :searchable="true" :close-on-select="true">
                            </multiselect>
                            <input type="hidden" id="selected_county" name="selected_county" value="{{$admin_user->county}}">
                            <input type="hidden" name="county" :value="selectedCounty">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><span><i class="mdi-maps-pin-drop bottom"></i></span>Location</label>
                            <input type="text" id="location" name="location" class="form-control" placeholder="Limuru" value="{{$admin_user->location}}">
                            <input type="hidden" id="location_lat_long" name="location_lat_long" value="{{$admin_user->location_lat_long}}">
                        </div>
                    </div>

                    @if($admin_user->role->name == 'Project Manager')
                        <div class="col-md-6">
                            <div class="form-group" id="gender">
                                <label>Gender</label>
                                <gender name="gender" v-model="selectedGender" :options="gender"
                                        placeholder="Select Gender"
                                        :searchable="true" :close-on-select="true">
                                </gender>
                                <input type="hidden" name="gender" :value="selectedGender">
                                <input type="hidden" id="saved_gender" value="{{$admin_user->gender}}" name="saved_gender">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" id="department">
                                <label>Department</label>
                                <department name="department" v-model="selectedDepartment" :options="departments"
                                            placeholder="Select Department"
                                            :searchable="true" :close-on-select="true">
                                </department>
                                <input type="hidden" name="department" :value="selectedDepartment">
                                <input type="hidden" id="saved_department" name="saved_department" value="{{$admin_user->department}}">
                            </div>
                        </div>
                    @elseif($admin_user->role->name == 'Center Manager')
                        @if($admin_user->center_id==null)
                            <div class="col-md-6">
                                <div class="form-group" id="gender">
                                    <label>Gender</label>
                                    <gender name="gender" v-model="selectedGender" :options="gender"
                                            placeholder="Select Gender"
                                            :searchable="true" :close-on-select="true">
                                    </gender>
                                    <input type="hidden" name="gender" :value="selectedGender">
                                    <input type="hidden" id="saved_gender" value="{{$admin_user->gender}}" name="saved_gender">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="center">
                                    <label>Center</label>
                                    <multiselect name="center" v-model="selectedCenter" :options="centers"
                                                 placeholder="Select Center" trackBy="id" label="name"
                                                 :searchable="true" :close-on-select="true">
                                    </multiselect>
                                    <input type="hidden" v-for="center in selectedCenter" name="center_id" :value="selectedCenter.id">
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <div class="form-group" id="gender">
                                    <label>Gender</label>
                                    <gender name="gender" v-model="selectedGender" :options="gender"
                                            placeholder="Select Gender"
                                            :searchable="true" :close-on-select="true">
                                    </gender>
                                    <input type="hidden" name="gender" :value="selectedGender">
                                    <input type="hidden" id="saved_gender" value="{{$admin_user->gender}}" name="saved_gender">
                                    <input type="hidden" value="{{$admin_user->center_id}}" name="center_id">
                                </div>
                            </div>
                        @endif
                    @elseif($admin_user->role->name == 'Trainer')
                        <div class="col-md-6">
                            <div class="form-group" id="gender">
                                <label>Gender</label>
                                <gender name="gender" v-model="selectedGender" :options="gender"
                                        placeholder="Select Gender"
                                        :searchable="true" :close-on-select="true">
                                </gender>
                                <input type="hidden" name="gender" :value="selectedGender">
                                <input type="hidden" id="saved_gender" value="{{$admin_user->gender}}" name="saved_gender">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group" id="speciality">
                                <label>Speciality</label>
                                <speciality name="department" v-model="selectedCategory" :options="categories"
                                            placeholder="Select Category"
                                            :searchable="true" :close-on-select="true">
                                </speciality>
                                <input type="hidden" name="speciality" :value="selectedCategory">
                                <input type="hidden" id="saved_speciality" name="speciality" value="{{$admin_user->speciality}}">
                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <div class="form-group" id="gender">
                                <label>Gender</label>
                                <gender name="gender" v-model="selectedGender" :options="gender"
                                        placeholder="Select Gender"
                                        :searchable="true" :close-on-select="true">
                                </gender>
                                <input type="hidden" name="gender" :value="selectedGender">
                                <input type="hidden" id="saved_gender" value="{{$admin_user->gender}}" name="saved_gender">
                            </div>
                        </div>
                    @endif
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea class="form-control" name="bio" cols="30" rows="5">
                                {{$admin_user->bio}}
                        </textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <button type="submit" class="float-left btn btn-outline-info">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
