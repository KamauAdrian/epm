<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="clienttable" class="table table-center mb-0 ">
                <thead>
                <tr>
                    <th>Project Manager</th>
                    <th>active projects</th>
                    <th class="text-right">Members</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($mentors as $mentor)
                    <tr>
                        <td>
                            <div class="media">
                                <span class="avtar avtar-icon avtar-square "><img src="{{url('assets/images/uikit/logo-apple.svg')}}" alt="images" class="img-fluid"></span>
                                <div class="media-body ml-3 align-self-center">
                                    <h5 class="mb-1">{{$mentor->name}}</h5>
                                    <p class="mb-0">{{$mentor->email}}</p>
                                </div>
                            </div>
                        </td>
                        <td>9 <i class="feather icon-arrow-up text-success"></i></td>
                        <td class="text-right">
                            <span class="avtar text-blue-2 bg-blue-1 avtar-xs mr-2">AS</span>
                            <img src="{{url('assets/images/user/avatar-3.jpg')}}" alt="images" class="img-fluid avtar avtar-xs mr-2">
                            <img src="{{url('assets/images/user/avatar-2.jpg')}}" alt="images" class="img-fluid avtar avtar-xs mr-2">
                            <img src="{{url('assets/images/user/avatar-4.jpg')}}" alt="images" class="img-fluid avtar avtar-xs mr-2">
                            <img src="{{url('assets/images/user/avatar-1.jpg')}}" alt="images" class="img-fluid avtar avtar-xs mr-2">
                            <button type="button" class="btn btn-icon mr-2">+5</button>
                            <button type="button" class="btn btn-icon"><i class="feather icon-plus"></i></button>
                        </td>
                        <td class="text-right">
                            <div class="float-right">
                                <div class="btn-group card-option">
                                    <button type="button" class="btn shadow-none ">
                                        <i class="feather icon-plus"></i>
                                    </button>
                                    <button type="button" class="btn shadow-none px-0 dropdown-toggle no-arrow" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="feather icon-more-horizontal"></i>
                                    </button>
                                    <ul class="list-unstyled card-option dropdown-menu dropdown-menu-right">
                                        <li class="dropdown-item reload-card"><a href="#!"><i class="feather icon-refresh-cw"></i> reload</a></li>
                                        <li class="dropdown-item close-card"><a href="#!"><i class="feather icon-trash"></i> remove</a></li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
