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
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>ID Number</th>
                                    <th>Day one</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="" name="name" type="text" placeholder="Adrian">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="" name="email" type="text" placeholder="">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="" name="phone" type="text" placeholder="Adrian">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12" id="traineeGender1">
                                            <div class="form-group">
                                                <input class="" name="gender" type="text" placeholder="Male/Female">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="" name="id_number" type="text" placeholder="36748284">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-md-12" id="presentAbsent1">
                                            <div class="form-group">
                                                <input class="" name="id_number" type="text" placeholder="dayOne">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
