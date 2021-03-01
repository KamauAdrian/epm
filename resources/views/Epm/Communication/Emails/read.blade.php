@extends("Epm.Communication.Emails.master")

@section("eContent")
<div class="col-xl-10 col-md-9">
    <div class="card">
        <div class="card-header">
            <h6 class="d-inline-block m-0">Here You Have New Opportunity...</h6>
            <p class="float-right m-0"><strong>08:23 AM</strong></p>
        </div>
        <div class="card-body">
            <div class="email-read">
                <div class="photo-table m-r-10">
                    <a href="#">
                        <img class="media-object img-radius" src="assets/images/user/avatar-1.jpg" alt="E-mail user" style="width:50px;">
                    </a>
                </div>
                <div>
                    <a href="#">
                        <p class="user-name text-dark mb-1"><strong>John Doe</strong></p>
                    </a>
                    <a class="user-mail txt-muted" href="#">
                        <p class="user-name text-dark mb-1"><strong>From:johndoe7869@gmail.com</strong></p>
                    </a>
                </div>
            </div>
            <div class="m-b-20 m-l-50 p-l-10 email-contant">
                <div class="photo-contant">
                    <div>
                        <p class="user-name text-dark mb-1"><strong>Hello Dear...</strong></p>
                        <div class="email-content">
                            <p class="">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                montes, nascetur ridiculus mus.Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis.
                            </p>
                            <ul>
                                <li>Lorem ipsum dolor sit amet</li>
                                <li>Consectetur adipiscing elit</li>
                                <li>Facilisis in pretium nisl aliquet</li>
                                <li>Nulla volutpat aliquam velit
                                    <ul>
                                        <li>Phasellus iaculis neque</li>
                                        <li>Purus sodales ultricies</li>
                                    </ul>
                                </li>
                                <li>Faucibus porta lacus fringilla vel</li>
                                <li>Eget porttitor lorem</li>
                            </ul>
                            <blockquote class="blockquote">
                                <p class="mb-2">
                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient
                                    montes, nascetur ridiculus mus.
                                </p>
                                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                            </blockquote>
                        </div>
                    </div>
                    <div class="m-t-15">
                        <i class="feather icon-paperclip f-20 m-r-10"></i>Attachments <b>(3)</b>
                        <div class="row mail-img m-t-20">
                            <div class="col-sm-4 col-md-3 col-xl-2 m-b-20">
                                <a href="assets/images/slider/img-slide-2.jpg" data-toggle="lightbox" data-title="Nextro Image 1" data-footer="Nextro Image 1"><img src="assets/images/slider/img-slide-2.jpg"
                                                                                                                                                                    class="img-fluid img-thumbnail" alt=""></a>
                            </div>
                            <div class="col-sm-4 col-md-3 col-xl-2 m-b-20">
                                <a href="assets/images/slider/img-slide-1.jpg" data-toggle="lightbox" data-title="Nextro Image 2" data-footer="Nextro Image 2"><img src="assets/images/slider/img-slide-1.jpg"
                                                                                                                                                                    class="img-fluid img-thumbnail" alt=""></a>
                            </div>
                            <div class="col-sm-4 col-md-3 col-xl-2 m-b-20">
                                <a href="assets/images/slider/img-slide-3.jpg" data-toggle="lightbox" data-title="Nextro Image 3" data-footer="Nextro Image 3"><img src="assets/images/slider/img-slide-3.jpg"
                                                                                                                                                                    class="img-fluid img-thumbnail" alt=""></a>
                            </div>
                        </div>
                        <form class="form-material">
                            <div class="form-group">
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Reply Your Thoughts" required="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
