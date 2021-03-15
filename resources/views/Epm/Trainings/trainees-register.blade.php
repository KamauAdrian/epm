@extends('Epm.Trainings.Layouts.training-master')

@section("trainingContent")
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Trainees Register</h5>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    @csrf
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>ID Number</th>
                                    @foreach($training->trainingDays as $trainingDay)
                                        <th>Day {{$trainingDay->day}}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                @if($trainees)
                                <tbody>
                                @foreach($trainees as $trainee)
                                    <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input style="border: none;" class="" name="name" type="text" placeholder="Adrian" value="{{$trainee->name}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input style="border: none;" class="" name="email" type="text" placeholder="" value="{{$trainee->email}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input style="border: none;" class="" name="phone" type="text" placeholder="Adrian" value="{{$trainee->phone_number}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12" id="traineeGender1">
                                            <div class="form-group">
                                                <input style="border: none;" class="" name="gender" type="text" placeholder="Male/Female" value="{{$trainee->gender}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input  style="border: none;" class="" name="id_number" type="text" placeholder="36748284" value="{{$trainee->id_number}}">
                                            </div>
                                        </div>
                                    </td>
                                    @foreach($training->trainingDays as $trainingDay)
                                        <?php $present = $trainingDay->trainees()->find($trainee->id); ?>
                                            <td>
                                                <div class="col-md-12 presentAbsent" id="presentAbsent{{$trainingDay->id}}">
                                                    <div class="form-group">
                                                        <div class="form-check">
                                                            <input name="poll{{$trainingDay->id}},{{$trainee->id}}" onclick="markPresentPhysical({{$training->id}},{{$trainingDay->id}},{{$trainee->id}})" class="form-check-input" type="radio" value="" id="flexCheckDefault"
                                                            <?php if ($present){ ?> checked <?php } ?> >
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Present
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="poll{{$trainingDay->id}},{{$trainee->id}}" onclick="markAbsentPhysical({{$training->id}},{{$trainingDay->id}},{{$trainee->id}})" class="form-check-input" type="radio" value="" id="flexCheckDefault"
                                                                   <?php if (!$present){ ?> checked <?php } ?> >
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Absent
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                    @endforeach
                                </tr>
                                @endforeach
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
