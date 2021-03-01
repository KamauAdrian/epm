@extends("Epm.Communication.Emails.master")

@section("eContent")
    <div class="col-xl-10 col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="mail-body-content">
                <form class="form-material">
                    <div class="form-group">
                        <label for="exampleInputEmail1">To</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Cc</label>
                                    <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Enter email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Bcc</label>
                                    <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail4">Subject</label>
                        <input type="email" class="form-control" id="exampleInputEmail4" placeholder="Subject">
                    </div>
                    <textarea id="tinymce-editor" name="name">Put your things hear...</textarea>
                    <div class="float-right mt-3">
                        {{--                                                    <button type="button" class="btn waves-effect waves-light btn-secondary">Save as draft</button>--}}
                        <button type="button" class="btn btn-outline-info">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
