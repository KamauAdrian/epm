<form class="my-5" method="post" action="{{url('/adm/save/center')}}">
    @csrf
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label>Center Name</label>
                <input type="text" name="name" class="form-control" placeholder="i.e Limuru" value="{{old('name')}}">
                <span class="text-danger">{{$errors->first('name')}}</span>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group" id="county">
                <label>County</label>
                <multiselect name="county" v-model="selectedCounty" :options="counties"
                             placeholder="Search"
                             :searchable="true" :close-on-select="true">
                </multiselect>
                <input type="hidden" name="county" :value="selectedCounty">
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label><span><i class="mdi-maps-pin-drop bottom"></i></span>Location</label>
                <input type="text" id="location" name="location" class="form-control" placeholder="Limuru" value="{{old('location')}}">
                <input type="hidden" id="location_lat_long" name="location_lat_long">
                <span class="text-danger">{{$errors->first('location')}}</span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group float-right">
                <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Add Center</button>
            </div>
        </div>
    </div>
</form>
