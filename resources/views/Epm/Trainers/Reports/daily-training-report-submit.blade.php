@extends('Epm.layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{url('/assets/dist/vue-multiselect.min.css')}}">
@endsection

@section('content')
    <?php
    $auth_admin = auth()->user();
    ?>

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/adm/'.$auth_admin->id.'/view/daily/training/reports')}}">Daily Reports</a></li>
                        {{--                        <li class="breadcrumb-item"><a href="#!">Submit Daily Report</a></li>--}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="auth-wrapper align-items-stretch bg-white">
                <div class="auth-side-form">
                    <div class="auth-content">
                        <div class="text-center">
                            <h1 class="f-w-400">Daily Training Report</h1>
                        </div>
                        <form action="{{url('/adm/'.$auth_admin->id.'/save/daily/training/report')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>This report helps in understanding how you conduct your day to day training, including any achievements or challenges you have encountered.</p>
                                        <p> The report should be submitted everyday at the end of the training session. In case of any challenges contact the Ajira Program Management Team for support.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$trainer->name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input type="email" name="email" class="form-control" value="{{$trainer->email}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="phone" class="form-control" value="{{$trainer->phone}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee Number</label>
                                        <input type="text" name="employee_number" class="form-control" value="{{$trainer->employee_number}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <?php $date = date('Y-m-d'); ?>
                                        <input type="date" name="date" class="form-control" value="{{$date}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Type Of Training</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="training_type" value="Virtual Training"> Virtual Training
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" name="training_type" value="Physical Training"> Physical Training
                                        <span class="text-danger">{{$errors->first('total_trainees')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <span class="text-danger">{{$errors->first('training_category')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Online Work Category trained </label>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Data Entry/Management"
                                                   id="checkCategory1" name="training_category"
                                                   <?php if ($auth_admin->speciality == 'Data Entry/Management'){ ?> checked="checked"
                                            <?php } ?>
                                            >
                                            <label for="checkCategory1" class="form-check-label">Data Entry/Management</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Virtual Assistant"
                                                   id="checkCategory5" name="training_category"
                                                   <?php if ($auth_admin->speciality == 'Virtual Assistant'){ ?> checked="checked"
                                            <?php } ?>
                                            >
                                            <label for="checkCategory5" class="form-check-label">Virtual Assistant</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Transcription"
                                                   id="checkCategory3" name="training_category"
                                                   <?php if ($auth_admin->speciality == 'Transcription'){ ?> checked="checked"
                                            <?php } ?>
                                            >
                                            <label for="checkCategory3" class="form-check-label">Transcription</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Digital Marketing/Ecommerce"
                                                   id="checkCategory2" name="training_category"
                                                   <?php if ($auth_admin->speciality == 'Digital Marketing/Ecommerce'){ ?> checked="checked"
                                            <?php } ?>
                                            >
                                            <label for="checkCategory2" class="form-check-label">Digital Marketing/Ecommerce</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" value="Content Writing and Translation"
                                                   id="checkCategory4" name="training_category"
                                                   <?php if ($auth_admin->speciality == 'Content Writing and Translation'){ ?> checked="checked"
                                            <?php } ?>
                                            >
                                            <label for="checkCategory4" class="form-check-label">Content Writing and Translation</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many trainees attended the training?</label>
                                        <input type="text" name="total_trainees" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many of the trainees were women? </label>
                                        <input type="text" name="total_trainees_female" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_female')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How many of the trainees were men?</label>
                                        <input type="text" name="total_trainees_male" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('total_trainees_male')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What achievements and challenges did you encounter as a trainer?</label>
                                        <input type="text" name="trainer_challenges_achievements" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('trainer_challenges_achievements')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What would you recommend to make the training better?</label>
                                        <input type="text" name="training_recommendation" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('training_recommendation')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>What support do you need to perform your role better?</label>
                                        <input type="text" name="training_support" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('training_support')}}</span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Upload a Photo of the training</label>
                                        <input type="file" name="training_photo" class="form-control" placeholder="Your Answer" required>
                                        <span class="text-danger">{{$errors->first('training_photo')}}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12" id="btn_submit">
                                    <div class="form-group float-right mt-2">
                                        <button type="submit" class="btn btn-outline-info btn-lg mb-3">Submit</button>
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
    <script>
        new Vue({
            components: {
                county: window.VueMultiselect.default,
            },
            data() {
                return {
                    selectedCounty: null,
                    counties: [
                        'Baringo','Bomet','Bungoma','Busia','Elgeyo Marakwet','Embu','Garissa','Homa Bay', 'Kajiado',
                        'Kakamega','Kericho','Kiambu','Kilifi','Kirinyaga','Kisii','Kisumu','Kitui','Kwale', 'Laikipia',
                        'Lamu','Machakos','Makueni','Mandera','Meru','Migori','Marsabit','Muranga','Nairobi','Nakuru','Nandi',
                        'Narok','Nyamira','Nyandarua','Nyeri','Samburu','Siaya','Taita Taveta','Tana River','Tharaka Nithi',
                        'Trans Nzoia','Turkana','Uasin Gishu','Vihiga','Wajir','West Pokot'
                    ],
                }
            },
            methods:{
            },
        }).$mount('#county')
        function showInputOther(){
            var other = document.getElementById('checkRole6');
            var spother = document.getElementById('otherSpecify');
            if (other.checked==true){
                spother.style.display='block';
            }else {
                spother.style.display='none';
            }
        }
    </script>
    <style src="{{url('assets/dist/vue-multiselect.min.css')}}"></style>
@endsection
