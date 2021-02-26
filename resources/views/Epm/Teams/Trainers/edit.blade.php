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
                            <h1 class="f-w-400">Add Trainer Team Members for {{$team->name}}</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" method="post" action="{{url('/adm/'.$auth_admin->id.'/save/team/trainer/members/team_id='.$team->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div team_id="{{$team->id}}" class="form-group" id="trainers_new">
                                        <label>Choose Team Member</label>
                                        <multiselect name="cms" v-model="selectedTrainer" :options="trainers"
                                                     placeholder="Search" label="name" track-by="id"
                                                     :searchable="true" :close-on-select="true" multiple>
                                        </multiselect>
                                        <input type="hidden" v-for="member in selectedTrainer" name="trainer_team_member_s_id[]" :value="member.id">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-info btn-block mb-3">Add Members</button>
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
    <script>
        new Vue({
            components: {
                multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedTrainer: null,
                    trainers: [],
                }
            },
            mounted () {
                var idTeam = this.$el.attributes.team_id.value;
                var idTim = document.getElementById('trainers_new');
                console.log(idTim.attributes.team_id);
                console.log(idTeam);
                console.log('/trainers/new/'+this.$el.attributes.team_id.value);
                this.getCms()
                // this.getCms(this.cms)
            },
            methods:{
                getCms(){
                    axios
                        .get('/trainers/new/team/members/'+this.$el.attributes.team_id.value)
                        .then(response => {
                            this.trainers = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                }
            },
        }).$mount('#trainers_new')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
