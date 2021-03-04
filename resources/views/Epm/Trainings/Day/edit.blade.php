@extends("Epm.layouts.master")

@section("content")
    <?php
    $auth_admin = auth()->user();
    ?>
    <div class="col-md-12">
        <form action="#!">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Facilitator</label>
                        <input type="text" class="form-control" placeholder="Select Session Facilitator">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group float-right">
                        <input class="btn btn-outline-info" type="submit" value="Save">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
