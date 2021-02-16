@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Edit Project</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/update/project/'.$project->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Luke S" value="{{$project->name}}" readonly>
                                    </div>
                                </div>
                                @if($project->collaborators)
                                    <p>{{count($project->collaborators)}}</p>
                                @endif
                                <div class="col-sm-12">
                                    <div class="form-group" id="collaborators" project_id="{{$project->id}}">
                                        <label>Add New Collaborators</label>
                                        <multiselect v-model="selectedPmo" :options="pmos"
                                                     placeholder="Search" trackBy="id" label="name"
                                                     :searchable="true" :close-on-select="true" multiple>
                                        </multiselect>
                                        <input type="hidden" name="collaborators[]" v-for="pmo in selectedPmo" :value="pmo.id">
                                        <span class="text-danger">{{$errors->first('collaborators')}}</span>
                                    </div>
                                </div>
                                @if($project->due_date)
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Project Due Date</label>
                                            <input type="date" name="due_date" class="form-control" value="{{$project->due_date}}">
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Add Project Due Date</label>
                                            <input type="date" name="due_date" class="form-control">
                                        </div>
                                    </div>
                                @endif
                                @if($project->description)
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Project Description</label>
                                            <textarea name="description" class="form-control" placeholder="Short Team Description" cols="30" rows="5">{{$project->description}}</textarea>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Add Project Description</label>
                                            <textarea name="description" class="form-control" placeholder="Short Team Description" cols="30" rows="5">{{$project->description}}</textarea>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-primary btn-lg mb-3">Update Project</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedPmo: null,
                    pmos: [],
                }
            },
            mounted () {
                this.getPmos()
            },
            methods:{
                getPmos(){
                    axios
                        .get('/new/collaborators/project_id='+this.$el.attributes.project_id.value)
                        .then(response => {
                            this.pmos = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#collaborators')

    </script>
@endsection
