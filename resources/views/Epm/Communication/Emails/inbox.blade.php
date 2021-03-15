@extends("Epm.Communication.Emails.master")

@section("eContent")
{{--    <div class="col-xl-10 col-md-9 inbox-right">--}}
{{--        <div class="email-btn">--}}
{{--            <button type="button" class="btn waves-effect waves-light btn-icon btn-rounded btn-outline-secondary mb-2"><i class="feather icon-alert-circle"></i></button>--}}
{{--            <button type="button" class="btn waves-effect waves-light btn-icon btn-rounded btn-outline-secondary mb-2"><i class="feather icon-inbox"></i></button>--}}
{{--            <button type="button" class="btn waves-effect waves-light btn-icon btn-rounded btn-outline-secondary mb-2"><i class="feather icon-trash-2"></i></button>--}}
{{--            <div class="btn-group mb-2 mr-2 ">--}}
{{--                <button class="btn drp-icon btn-rounded btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-log-out"></i></button>--}}
{{--                <div class="dropdown-menu">--}}
{{--                    <a class="dropdown-item" href="#">Move to</a>--}}
{{--                    <div class="dropdown-divider"></div>--}}
{{--                    <a class="dropdown-item pl-4" href="#"><span><i class="feather icon-users mr-2"></i>Social</span></a>--}}
{{--                    <a class="dropdown-item pl-4" href="#"><span><i class="feather icon-tag mr-2"></i>Promotion</span></a>--}}
{{--                    <a class="dropdown-item pl-4" href="#"><span><i class="feather icon-upload-cloud mr-2"></i>Update</span></a>--}}
{{--                    <a class="dropdown-item pl-4" href="#"><span><i class="feather icon-message-square mr-2"></i>Forum</span></a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="btn-group mb-2 mr-2 ">--}}
{{--                <button class="btn drp-icon btn-rounded btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-vertical"></i></button>--}}
{{--                <div class="dropdown-menu">--}}
{{--                    <a class="dropdown-item" href="#!">Mark as unread</a>--}}
{{--                    <a class="dropdown-item" href="#!">Mark as important</a>--}}
{{--                    <a class="dropdown-item" href="#!">Mark as not important</a>--}}
{{--                    <a class="dropdown-item" href="#!">Filter messages like these</a>--}}
{{--                    <a class="dropdown-item" href="#!">Mute</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="tab-content p-0" id="v-pills-tabContent">
            <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <ul class="nav nav-pills nav-fill mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-primary-tab" data-toggle="pill" href="#pills-primary" role="tab" aria-controls="pills-primary" aria-selected="true"><span><i
                                    class="feather icon-inbox"></i>
                                                                    primary</span></a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="pills-social-tab" data-toggle="pill" href="#pills-social" role="tab" aria-controls="pills-social" aria-selected="false"><span><i class="feather icon-users"></i>--}}
{{--                                                                    Social</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="pills-Promotion-tab" data-toggle="pill" href="#pills-Promotion" role="tab" aria-controls="pills-Promotion" aria-selected="false"><span><i--}}
{{--                                    class="feather icon-tag"></i>--}}
{{--                                                                    Promotions</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="pills-update-tab" data-toggle="pill" href="#pills-update" role="tab" aria-controls="pills-update" aria-selected="false"><span><i--}}
{{--                                    class="feather icon-upload-cloud"></i>--}}
{{--                                                                    Update</span></a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" id="pills-forum-tab" data-toggle="pill" href="#pills-forum" role="tab" aria-controls="pills-forum" aria-selected="false"><span><i class="feather icon-message-square"></i>--}}
{{--                                                                    Forum</span></a>--}}
{{--                    </li>--}}
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-primary" role="tabpanel" aria-labelledby="pills-primary-tab">
                        <div class="mail-body-content table-responsive">
                            <table class="table">
                                <tbody>
                                <tr class="unread">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-1" id="checkbox-s-infill-1">
                                                    <label for="checkbox-s-infill-1" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">John Doe</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Coming Up Next Week</a></td>
                                    <td class="email-time">13:02 PM</td>
                                </tr>
                                <tr class="unread">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-2" id="checkbox-s-infill-2">
                                                    <label for="checkbox-s-infill-2" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star-on text-c-yellow ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Google Inc</a></td>
                                    <td>
                                        <a href="adm-em-read.html" class="email-name waves-effect">Lorem ipsum dolor sit amet, consectetuer</a>
                                        <div><a href="#!" class="mail-attach"><i class="feather icon-image mr-2"></i>user.png</a>
                                            <a href="#!" class="mail-attach ml-2"><i class="feather icon-file-text mr-2"></i>file.doc</a>
                                        </div>
                                    </td>

                                    <td class="email-time">12:01 AM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-3" id="checkbox-s-infill-3">
                                                    <label for="checkbox-s-infill-3" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Sara Soudein</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">SVG new updates comes for you</a></td>
                                    <td class="email-time">00:05 AM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-4" id="checkbox-s-infill-4">
                                                    <label for="checkbox-s-infill-4" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Rinky Behl</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Photoshop updates are available</a></td>
                                    <td class="email-time">10:01 AM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-5" id="checkbox-s-infill-5">
                                                    <label for="checkbox-s-infill-5" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star-on text-c-yellow ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Harry John</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">New upcoming data available</a></td>
                                    <td class="email-time">11:01 AM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-6" id="checkbox-s-infill-6">
                                                    <label for="checkbox-s-infill-6" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Hanry Joseph</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">SCSS current working for new updates</a></td>
                                    <td class="email-time">12:01 PM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-7" id="checkbox-s-infill-7">
                                                    <label for="checkbox-s-infill-7" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Liu Koi Yan</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Charts waiting for you</a>
                                        <div><a href="#!" class="mail-attach"><i class="feather icon-film mr-2"></i>video</a></div>
                                    </td>
                                    <td class="email-time">07:15 AM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-8" id="checkbox-s-infill-8">
                                                    <label for="checkbox-s-infill-8" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star-on text-c-yellow ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Google Inc</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Lorem ipsum dolor sit amet, consectetuer adipiscing elit</a></td>
                                    <td class="email-time">08:01 AM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-9" id="checkbox-s-infill-9">
                                                    <label for="checkbox-s-infill-9" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">John Doe</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Coming Up Next Week</a></td>
                                    <td class="email-time">13:02 PM</td>
                                </tr>
                                <tr class="read">
                                    <td>
                                        <div class="check-star">
                                            <div class="form-group d-inline">
                                                <div class="checkbox checkbox-primary checkbox-fill d-inline">
                                                    <input type="checkbox" name="checkbox-s-in-10" id="checkbox-s-infill-10">
                                                    <label for="checkbox-s-infill-10" class="cr"></label>
                                                </div>
                                            </div>
                                            <a href="#"><i class="feather icon-star ml-2"></i></a>
                                        </div>
                                    </td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">Hanry Joseph</a></td>
                                    <td><a href="adm-em-read.html" class="email-name waves-effect">SCSS current working for new updates</a>
                                        <div><a href="#!" class="mail-attach"><i class="feather icon-file-text mr-2"></i>file.doc</a></div>
                                    </td>
                                    <td class="email-time">12:01 PM</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
