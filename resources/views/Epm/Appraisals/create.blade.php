@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php $auth_admin = auth()->user(); ?>
    {{--    @include('Epm.layouts.Reports.templates')--}}
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Add New PMO Performance Appraisal</h1>
                        </div>
                        <?php
                        $auth_admin = auth()->user();
                        ?>
                        <form class="my-5" id="create_appraisal" method="post" action="{{url('/adm/'.$auth_admin->id.'/add/pmo/performance/appraisal')}}">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" id="pmos">
                                        <label>Select PMO</label>
                                        <multiselect :options="pmos" v-model="selectedPmo"
                                                     placeholder="Search" label="name" track-by="id"
                                                     :searchable="true" :close-on-select="true"
                                        >
                                        </multiselect>
                                        <input type="hidden" name="pmo_id" v-for="pmo in selectedPmo"  :value="selectedPmo.id">
                                        <input type="hidden" name="pmo" v-for="pmo in selectedPmo"  :value="selectedPmo.name">
                                        <input type="hidden" name="pmo_email" v-for="pmo in selectedPmo"  :value="selectedPmo.email">
                                        <span class="text-danger">{{$errors->first('pmo')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="supervisor">
                                        <label>Select Supervisor</label>
                                        <multiselect :options="supervisors" v-model="selectedSupervisor"
                                                     placeholder="Search" label="name" track-by="id"
                                                     :searchable="true" :close-on-select="true"
                                                     multiple>
                                        </multiselect>
                                        <input type="hidden" name="supervisor_ids[]" v-for="supervisor in selectedSupervisor"  :value="supervisor.id">
                                        <input type="hidden" name="supervisor_names[]" v-for="supervisor in selectedSupervisor"  :value="supervisor.name">
                                        <input type="hidden" name="supervisor_emails[]" v-for="supervisor in selectedSupervisor"  :value="supervisor.email">
                                        <span class="text-danger">{{$errors->first('supervisor_ids')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Appraisal Questions</label>
                                    </div>
                                    <div class="form-group">
                                        <div id="question_one"></div>
                                        <input type="hidden" id="input_question_one" name="question_one" value="">
                                    </div>
                                    <div class="form-group">
                                        <div id="question_two"></div>
                                        <input type="hidden" id="input_question_two" name="question_two" value="">
                                    </div>
                                    <div class="form-group">
                                        <div id="question_three"></div>
                                        <input type="hidden" id="input_question_three" name="question_three" value="">
                                    </div>
                                    <div class="form-group">
                                        <div id="question_four"></div>
                                        <input type="hidden" id="input_question_four" name="question_four" value="">
                                    </div>
                                    <div class="form-group">
                                        <div id="question_five"></div>
                                        <input type="hidden" id="input_question_five" name="question_five" value="">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group float-right">
                                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Create Appraisal</button>
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
    <script type="text/javascript">
        var quiz1 = new Quill("#question_one", {
            modules: {
                toolbar: true
                // toolbar: [
                //         [{ header: [1, 2, false] }],
                //         ['bold', 'italic'],
                //         ['link', 'blockquote', 'code-block', 'image'],
                //         [{ list: 'ordered' }, { list: 'bullet' }]
                //     ]
            },
            placeholder: "Add Question One",
            theme: "snow"
        });
        var quiz2 = new Quill("#question_two", {
            modules: {
                toolbar: true
            },
            placeholder: "Add Question Two",
            theme: "snow"
        });var quiz3 = new Quill("#question_three", {
            modules: {
                toolbar: true
            },
            placeholder: "Add Question Three",
            theme: "snow"
        });var quiz4 = new Quill("#question_four", {
            modules: {
                toolbar: true
            },
            placeholder: "Add Question Four",
            theme: "snow"
        });var quiz5 = new Quill("#question_five", {
            modules: {
                toolbar: true
            },
            placeholder: "Add Question Five",
            theme: "snow"
        });

        var input_q_one = document.getElementById("#input_question_one");
        var q_one = quiz1.root.innerHTML;
        var Delta = Quill.import('delta');
        // Store accumulated changes
        var change = new Delta();
        quiz1.on('text-change', function(delta) {
            quiz1Change = change.compose(delta);
        });
        quiz2.on('text-change', function(delta) {
            quiz2Change = change.compose(delta);
        });
        quiz3.on('text-change', function(delta) {
            quiz3Change = change.compose(delta);
        });
        quiz4.on('text-change', function(delta) {
            quiz4Change = change.compose(delta);
        });
        quiz5.on('text-change', function(delta) {
            quiz5Change = change.compose(delta);
        });
        // Save periodically
        setInterval(function() {
            if (quiz1Change.length() > 0) {
                console.log('Saving changes', change);
                $("#input_question_one").val(quiz1.root.innerHTML);
                quiz1Change = new Delta();
            }
            if (quiz2Change.length() > 0) {
                $("#input_question_two").val(quiz2.root.innerHTML);
                quiz2Change = new Delta();
            }
            if (quiz3Change.length() > 0) {
                $("#input_question_three").val(quiz3.root.innerHTML);
                quiz3Change = new Delta();
            }
            if (quiz4Change.length() > 0) {
                $("#input_question_four").val(quiz4.root.innerHTML);
                quiz4Change = new Delta();
            }
            if (quiz5Change.length() > 0) {
                $("#input_question_five").val(quiz5.root.innerHTML);
                quiz5Change = new Delta();
            }
        }, 1000);
        // Check for unsaved data
        window.onbeforeunload = function() {
            if (change.length() > 0) {
                return 'There are unsaved changes. Are you sure you want to leave?';
            }
        }

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
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/pmos')
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
        }).$mount('#pmos')
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedSupervisor: null,
                    supervisors: [],
                }
            },
            mounted () {
                this.getAdmins()
            },
            methods:{
                getAdmins(){
                    axios
                        .get('/pmos')
                        .then(response => {
                            this.supervisors = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#supervisor')
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
