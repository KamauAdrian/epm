@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
    <script src="{{url('assets/js/jquery.min.js')}}"></script>
    <link rel="stylesheet" href="{{url('/assets/css/star-rating-svg.css')}}">
    <style>
        .rating-stars{
            width: 12em;
        }
        .rating-stars ul {
            list-style-type:none;
            padding:0;

            -moz-user-select:none;
            -webkit-user-select:none;
        }
        .rating-stars ul > li.star {
            display:inline-block;

        }

        /* Idle State of the stars */
        .rating-stars ul > li.star > i.fa {
            font-size:1.5em; /* Change the size of the stars */
            color:#ccc; /* Color on idle state */
        }

        /* Hover state of the stars */
        .rating-stars ul > li.star.hover > i.fa {
            color:#FFCC36;
        }

        /* Selected state of the stars */
        .rating-stars ul > li.star.selected > i.fa {
            color:#FF912C;
        }
    </style>
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
                                            <multiselect v-model="selectedTrainer" :options="trainers"
                                                         placeholder="Select Trainer" label="name" track-by="id"
                                                         :searchable="true" :close-on-select="true" required="required">
                                            </multiselect>
                                            <input type="hidden" v-for="trainer in selectedTrainer" name="trainer_id" :value="selectedTrainer.id">
                                            <input type="hidden" v-for="trainer in selectedTrainer" name="trainer_name" :value="selectedTrainer.name">
                                            <span class="text-danger">{{$errors->first('trainer_id')}}</span>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Evaluation Date</label>
                                        <input type="date" name="date" class="form-control" required>
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
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q1' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q1">
                                                </td>
                                                <td><ul><li>maintained good eye contact <br> with the audience.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='body_language_q1' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="body_language[]" value="" id="rating_body_language_q1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used a voice loud and clear<br />enough to hear easily.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q2' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q2">
                                                </td>
                                                <td><ul><li>was friendly and smiled.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='body_language_q2' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="body_language[]" value="" id="rating_body_language_q2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>delivered a talk designed in a <br>logical way from beginning to <br>middle and end,</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q3' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q3">
                                                </td>
                                                <td><ul><li>used body language to help <br>communicate ideas visually</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='body_language_q3' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="body_language[]" value="" id="rating_body_language_q3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>clearly described what to expect <br> from the presentation.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q4' class="stars_hover" >
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q4">
                                                </td>
                                                <td class="thead-light"><b>Audience Participation</b> — the trainer:</td>
                                                <td>Rating</td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used effective examples and <br> illustrations.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q5' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q5">
                                                </td>
                                                <td><ul><li>involved the audience.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='audience_participation_q1' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="audience_participation[]" value="" id="rating_audience_participation_q1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>defined unfamiliar technical terms.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q6' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q6">
                                                </td>
                                                <td><ul><li>handled questions and <br>comments with calm courtesy.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='audience_participation_q2' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="audience_participation[]" value="" id="rating_audience_participation_q2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>summarized the main points <br> before finishing.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='delivery_q7' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="delivery[]" value="" id="rating_delivery_q7">
                                                </td>
                                                <td><ul><li>broke up lectures/discussion at <br>appropriate points.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='audience_participation_q3' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="audience_participation[]" value="" id="rating_audience_participation_q3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="thead-light"><b>Visual Aids</b> — the trainer:</td>
                                                <td>Rating</td>
                                                <td><ul><li>provided clear instructions for all <br>activities.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='audience_participation_q4' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="audience_participation[]" value="" id="rating_audience_participation_q4">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used visual aids</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='visual_aids_q1' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="visual_aids[]" value="" id="rating_visual_aids_q1">
                                                </td>
                                                <td><ul><li>clarified or rephrased questions <br>to elicit audience participation.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='audience_participation_q5' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="audience_participation[]" value="" id="rating_audience_participation_q5">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>made sure materials could be <br>read easily from where I was <br>sitting.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='visual_aids_q2' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="visual_aids[]" value="" id="rating_visual_aids_q2">
                                                </td>
                                                <td class="thead-light"><b>Technical Competency</b> — the trainer:</td>
                                                <td>Rating</td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>got the point across in a clear and <br>simple way.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='visual_aids_q3' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="visual_aids[]" value="" id="rating_visual_aids_q3">
                                                </td>
                                                <td><ul><li>taught technically accurate <br>content.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='technical_competence_q1' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="technical_competence[]" value="" id="rating_technical_competence_q1">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>did not block the screen or <br> flipchart.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='visual_aids_q4' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="visual_aids[]" value="" id="rating_visual_aids_q4">
                                                </td>
                                                <td><ul><li>answered technical questions <br>from the audience.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='technical_competence_q2' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="technical_competence[]" value="" id="rating_technical_competence_q2">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>talked to the audience rather than <br> to the screen or flipchart.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='visual_aids_q5' class="stars_hover" >
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="visual_aids[]" value="" id="rating_visual_aids_q5">
                                                </td>
                                                <td><ul><li>gauged audience level of <br>technical knowledge and <br>adjusted the presentation <br>accordingly.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='technical_competence_q3' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="technical_competence[]" value="" id="rating_technical_competence_q3">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><ul><li>used key words rather than <br> sentences</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='visual_aids_q6' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="visual_aids[]" value="" id="rating_visual_aids_q6">
                                                </td>
                                                <td><ul><li>accurately broke down <br>technical/complex concepts in a <br>way participants could <br>understand.</li></ul></td>
                                                <td>
                                                    <div class='rating-stars'>
                                                        <ul id='technical_competence_q4' class="stars_hover">
                                                            <li class='star' title='Poor' data-value='1'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Fair' data-value='2'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Good' data-value='3'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='Excellent' data-value='4'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                            <li class='star' title='WOW!!!' data-value='5'>
                                                                <i class='fa fa-star fa-fw'></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <input type="hidden" name="technical_competence[]" value="" id="rating_technical_competence_q4">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-center"><b>Please use the space below to specify:</b></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Specific topics where the trainer lacks technical knowledge/expertise:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" required name="topics_trainer_lacks_knowledge_expertise" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Ways the trainer might connect better with and engage the audience; be more inclusive:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" required name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Use materials more efficiently:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" required name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Use a clearer, more organized approach:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" required name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Use visual aids that better educate his or audience:</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4"><input type="text" style="border: none;" required name="ways_trainer_can_connect_with_audience[]" placeholder="Your Answer" class="form-control"></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info float-right">Submit Assessment</button>
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
        });
    </script>
    <script>
        $(document).ready(function(){
            /* 1. Visualizing things on Hover - See next part for action on click */
            $('.stars_hover li').on('mouseover', function(){
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e){
                    if (e < onStar) {
                        $(this).addClass('hover');
                    }
                    else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function(){
                $(this).parent().children('li.star').each(function(e){
                    $(this).removeClass('hover');
                });
            });
            /* 2. Action to perform on click */
            $('.stars_hover li').on('click', function(){
                var id = $(this).parent().attr("id");
                console.log(id);
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');
                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }
                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }
                var ratingValue = parseInt($('#'+id+' li.selected').last().data('value'), 10);
                $("#rating_"+id).val(ratingValue);
                console.log("rated "+ratingValue+ " Star");
            });
        });

        // }
    </script>
    <script src="{{url('assets/js/jquery.star-rating-svg.js')}}"></script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
