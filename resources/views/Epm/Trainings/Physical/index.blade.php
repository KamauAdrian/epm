<div class="card">
    <div class="card-header">
        <h5>Days</h5>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            @foreach($days as $key=>$day)
                <?php
                $trainers = $day->trainers;
                $classes = $day->classes;
                $trainees = $day->trainees;
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h5>Day {{$day->day}}</h5>
                                {{date("dS M Y",strtotime($day->date))}}
                            </div>
                            <div class="col-md-4">
                                <h5>Trainers</h5>
                                Trainers
                            </div>
                            <div class="col-md-4">
                                <h5>Trainees</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        Female:
                                    </div>
                                    <div class="col-md-6">
                                        12
                                    </div>
                                    <div class="col-md-6">
                                        Male:
                                    </div>
                                    <div class="col-md-6">
                                        12
                                    </div>
                                    <div class="col-md-6">
                                        Total:
                                    </div>
                                    <div class="col-md-6">
                                        24
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


