@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h1 class="f-w-400">TRAINER’S SKILLS COMPETENCIES CHECKLIST</h1>
                </div>
            </div>
            <div class="col-md-12">
                <form action="{{url('/adm/'.$auth_admin->id.'/save/trainer/competence/assessment')}}" method="post">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="row">
                                @csrf
                                @if($trainers!='')
                                    <div class="col-md-6">
                                        <div class="form-group" id="trainers">
                                            <label>Name of Trainer</label>
                                            <multiselect name="trainer" v-model="selectedTrainer" :options="trainers"
                                                         placeholder="Select Trainer" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true">
                                            </multiselect>
                                            <input type="hidden" v-for="trainer in selectedTrainer" name="trainer_id" :value="selectedTrainer.id">
                                            <input type="hidden" v-for="trainer in selectedTrainer" name="trainer_name" :value="selectedTrainer.name">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Date</label>
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Evaluator</label>
                                        <input type="text" name="evaluator" class="form-control" value="{{$auth_admin->name}}" disabled>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" id="training_category">
                                        <label>Training Category</label>
                                        <category name="training_category" v-model="selectedCategory" :options="categories"
                                                  placeholder="Search"
                                                  :searchable="true" :close-on-select="true">
                                        </category>
                                        <input type="hidden" name="training_category" :value="selectedCategory">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p><b>Please summarize trainer’s demonstrated knowledge/skills using the rating system below:</b></p>
                                        <p>1. Trainer shows strength in this area</p>
                                        <p>2. Trainer demonstrates some ability in this area</p>
                                        <p>3. Trainer needs additional support in this area</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td class="thead-light"><b>Delivery</b> — the trainer:</td>
                                                <td>Rating</td>
                                                <td class="thead-light"><b>Body Language</b> — the trainer:</td>
                                                <td>Rating</td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>greeted the audience warmly.</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td><ul><li>maintained good eye contact <br> with the audience.</li></ul></td>
                                                <td><input type="text" style="border: none" name="body_language[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used a voice loud and clear<br />enough to hear easily.</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td><ul><li>was friendly and smiled.</li></ul></td>
                                                <td><input type="text" style="border: none" name="body_language[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>delivered a talk designed in a <br>logical way from beginning to <br>middle and end,</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td><ul><li>used body language to help <br>communicate ideas visually</li></ul></td>
                                                <td><input type="text" style="border: none" name="body_language[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>clearly described what to expect <br> from the presentation.</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td class="thead-light"><b>Audience Participation</b> — the trainer:</td>
                                                <td><input type="text" style="border: none" name="" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used effective examples and <br> illustrations.</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td><ul><li>involved the audience.</li></ul></td>
                                                <td><input type="text" style="border: none" name="audience_participation[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>defined unfamiliar technical terms.</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td><ul><li>handled questions and <br>comments with calm courtesy.</li></ul></td>
                                                <td><input type="text" style="border: none" name="audience_participation[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>summarized the main points <br> before finishing.</li></ul></td>
                                                <td><input type="text" style="border: none" name="delivery[]" class="form-control"></td>
                                                <td><ul><li>broke up lectures/discussion at <br>appropriate points.</li></ul></td>
                                                <td><input type="text" style="border: none" name="audience_participation[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td class="thead-light"><b>Visual Aids</b> — the trainer:</td>
                                                <td><input type="text" style="border: none" name="" class="form-control"></td>
                                                <td><ul><li>provided clear instructions for all <br>activities.</li></ul></td>
                                                <td><input type="text" style="border: none" name="audience_participation[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used visual aids</li></ul></td>
                                                <td><input type="text" style="border: none" name="visual_aids[]" class="form-control"></td>
                                                <td><ul><li>clarified or rephrased questions <br>to elicit audience participation.</li></ul></td>
                                                <td><input type="text" style="border: none" name="audience_participation[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>made sure materials could be <br>read easily from where I was <br>sitting.</li></ul></td>
                                                <td><input type="text" style="border: none" name="visual_aids[]" class="form-control"></td>
                                                <td class="thead-light"><b>Technical Competency</b> — the trainer:</td>
                                                <td><input type="text" style="border: none" name="" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>got the point across in a clear and <br>simple way.</li></ul></td>
                                                <td><input type="text" style="border: none" name="visual_aids[]" class="form-control"></td>
                                                <td><ul><li>taught technically accurate <br>content.</li></ul></td>
                                                <td><input type="text" style="border: none" name="technical_competence[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>did not block the screen or <br> flipchart.</li></ul></td>
                                                <td><input type="text" style="border: none" name="visual_aids[]" class="form-control"></td>
                                                <td><ul><li>answered technical questions <br>from the audience.</li></ul></td>
                                                <td><input type="text" style="border: none" name="technical_competence[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>talked to the audience rather than <br> to the screen or flipchart.</li></ul></td>
                                                <td><input type="text" style="border: none" name="visual_aids[]" class="form-control"></td>
                                                <td><ul><li>gauged audience level of <br>technical knowledge and <br>adjusted the presentation <br>accordingly.</li></ul></td>
                                                <td><input type="text" style="border: none" name="technical_competence[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used key words rather than <br> sentences</li></ul></td>
                                                <td><input type="text" style="border: none" name="visual_aids[]" class="form-control"></td>
                                                <td><ul><li>accurately broke down <br>technical/complex concepts in a <br>way participants could <br>understand.</li></ul></td>
                                                <td><input type="text" style="border: none" name="technical_competence[]" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-center"><b>Please use the space below to specify:</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Specific topics where the trainer lacks technical knowledge/expertise:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" name="topics_trainer_lacks_knowledge_expertise" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Ways the trainer might connect better with and engage the audience; be more inclusive:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Use materials more efficiently:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Use a clearer, more organized approach:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Use visual aids that better educate his or audience:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-primary float-right">Submit Assessment</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{url('assets/dist/vue-multiselect.min.js')}}"></script>
    <script src="{{url('assets/dist/vue.js')}}"></script>
    <script src="{{url('assets/dist/axios.js')}}"></script>
    {{--    <script src="{{url('assets/js/index.js')}}"></script>--}}
    <script>
        new Vue({
            components: {
                Multiselect: window.VueMultiselect.default,
                axios: window.axios.defaults,
            },
            data() {
                return {
                    selectedTrainer: null,
                    trainers: [],
                }
            },
            mounted () {
                this.getTrainers()
            },
            methods:{
                getTrainers(){
                    axios
                        .get('/trainers')
                        .then(response => {
                            this.trainers = response.data
                        })
                        .catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = true)
                },
            },
        }).$mount('#trainers')
        new Vue({
            el: '#training_category',
            components: {
                category: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCategory: null,
                    categories: [
                        'Data Management','Digital Marketing','Transcription',
                        'Writing and Translation','Virtual Assistant'
                    ],
                }
            },
            methods:{
            },
        })
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
