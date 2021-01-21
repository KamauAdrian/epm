
<div class="col-sm-12">
    <div class="row">
        <div class="col-sm-12 mb-4 text-center">
            <h1 class="d-inline-block font-weight-normal mb-0">Edit {{$center->name}} Profile</h1>
        </div>
    </div>
    <form action="{{url('/adm/update/center',$center->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-3">
                @if($center->image)
                    <div class="form-group">
                        <figure class="figure">
                            <img src="{{url('Centers/images',$center->image)}}" class="figure-img img-fluid rounded" alt="...">
                            {{--                            <figcaption class="figure-caption text-center mt-2">Change photo</figcaption>--}}
                        </figure>
                        <label for="">Change Profile Photo</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                @else
                    <div class="form-group">
                        <figure class="figure">
                            <img src="{{url('assets/images/center.jpeg')}}" class="figure-img img-fluid rounded" alt="...">
                            {{--                            <figcaption class="figure-caption text-center mt-2">Upload photo</figcaption>--}}
                        </figure>
                        <label>Upload a Center Image</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{$center->name}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="county">
                            <label>County</label>
                            <multiselect name="county" v-model="selectedCounty" :options="counties"
                                         placeholder="Search"
                                         :searchable="true" :close-on-select="true">
                            </multiselect>
                            <input type="hidden" id="selected_county" name="selected_county" value="{{$center->county}}">
                            <input type="hidden" name="county" :value="selectedCounty">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><span><i class="mdi-maps-pin-drop bottom"></i></span>Location</label>
                            <input type="text" id="location" name="location" class="form-control" placeholder="Limuru" value="{{$center->location}}">
                            <input type="hidden" id="location_lat_long" name="location_lat_long" value="{{$center->location_lat_long}}">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Brief Center Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="5">
                                {{$center->description}}
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
