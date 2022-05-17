@extends('admin.layout.default')
@section('css')

@endsection

@section('content')
    <div class="main-container">
        {{-- Tables --}}
        <div class="row">
            <div class="col s6 m3">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">New Doctor - Activation Process</span>
                        <?php $g = 1;$k = 1;foreach($doctors as $doctor){?>
                        <div class="row linkprofile">
                            <input type="hidden" value="#profile{{$g}}">
                            <div class="col m3">
                                <img src="{{asset('upload/photo/'.$doctor->photo)}}"
                                     style="width:50px;height:50px;border-radius: 100%;">
                            </div>

                            <div class="col m9">
                                <p>{{$doctor->fname}} {{$doctor->lname}}</p>
                                <p>{{$doctor->country}} {{$doctor->city}} {{$doctor->area}}</p>
                            </div>
                        </div>
                        <?php $k = $g;$g++;}?>
                    </div>
                </div>
            </div>
            <div class="col s18 m9">
                <div class="card">
                    <div class="card-content">
                        <?php $g = 1;foreach($doctors as $doctor) {?>
                        <div class="bigphoto" id="profile{{$g}}" style="display:none">
                            <div style="padding:10px">
                                <div class="row">
                                    <div class="col m6">
                                        <span>First Name</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->fname}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Last Name</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->lname}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Degree</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->degree}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Menulist</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->menulist}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Specialist</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->specialist1}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Profile Photo</span>
                                    </div>
                                    <div class="col m6">
                                        <img src="{{asset('upload/photo/'.$doctor->photo)}}"
                                             style="width:100px;height:100px;border-radius: 100%;">
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Authorization</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->authorization_no}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Phone Number</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->phone}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Email</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->email}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>FaceBook Link</span>
                                    </div>
                                    <div class="col m6">
                                        <span><a href="{{$doctor->facebook_link}}">{{$doctor->facebook_link}}</a></span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Twitter Link</span>
                                    </div>
                                    <div class="col m6">
                                        <span><a href="{{$doctor->twitter_link}}">{{$doctor->twitter_link}}</a></span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Instagram Link</span>
                                    </div>
                                    <div class="col m6">
                                        <span><a
                                                href="{{$doctor->instagram_link}}">{{$doctor->instagram_link}}</a></span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Youtube Link</span>
                                    </div>
                                    <div class="col m6">
                                        <span><a href="{{$doctor->youtube_link}}">{{$doctor->youtube_link}}</a></span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Office Address</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->office_address}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Country</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->country}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>City</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->city}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Area</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->area}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Doctor CV</span>
                                    </div>
                                    <div class="col m6">
                                        <span>{{$doctor->doctor_cv}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Video Photo</span>
                                    </div>
                                    <div class="col m6">
                                        <img src="{{asset('upload/videophoto/'.$doctor->video_photo)}}"
                                             style="width:100px;height:100px;border-radius: 10%;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Video Link</span>
                                    </div>
                                    <div class="col m6">
                                        <span><a href="{{$doctor->video_link}}">{{$doctor->video_link}}</a></span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Register Fee Status</span>
                                    </div>
                                    <div class="col m6">
                                        <?php if($doctor->fee == 11){?>
                                        <span>Paid</span>
                                        <?php }else if($doctor->fee == 10){?>
                                        <span>unPaid with Enable</span>
                                        <?php }else{?>
                                        <span>unPaid with Disable</span>
                                        <?php }?>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row" style="margin: 10px !important;">
                                    <div class="col m4" style="text-align:left">
                                        <a class="waves-effect waves-light btn-large black makeeditdoctor" href="#makeeditdoctor">Edit Doctor</a>
                                        <input type="hidden" value="{{$doctor->id}}">
                                        <input type="hidden" value="{{$doctor->fname}}">
                                        <input type="hidden" value="{{$doctor->lname}}">
                                        <input type="hidden" value="{{$doctor->email}}">
                                    </div>
                                    <div class="col m4" style="text-align:center">
                                        <a class="waves-effect waves-light btn-large black resetBalance">Reset Balance</a>
                                        <input type="hidden" value="{{$doctor->id}}">
                                    </div>
                                    <div class="col m4 action-btns" style="text-align: right">
                                        <a class="btn-floating warning-bg makemodalprice" href="#modalprice"
                                           data-target="modalprice">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <input type="hidden" value="{{$doctor->id}}">
                                        <input type="hidden" value="{{$doctor->remain_chat}}">
                                        <input type="hidden" value="{{$doctor->remain_call}}">
                                        <input type="hidden" value="{{$doctor->remain_video}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col m4" style="text-align:left">
                                    <?php if($g > 1){?>
                                    <a class="waves-effect waves-light btn-large linkprofile"><i
                                            class="material-icons left">skip_previous</i>Previous Dr</a>
                                    <input type="hidden" value="#profile{{$g-1}}">
                                    <?php }?>
                                </div>
                                <div class="col m4" style="text-align:center">
                                    <a class="waves-effect waves-light btn-large black declinedoctor">Decline</a>
                                    <input type="hidden" value="{{$doctor->id}}">
                                </div>
                                <div class="col m4" style="text-align:right">
                                    <?php if($g < $k){?>
                                    <a href="#three" class="waves-effect waves-light btn-large linkprofile"><i
                                            class="material-icons right">skip_next</i>Next Dr</a>
                                    <input type="hidden" value="#profile{{$g+1}}">
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php $g++;}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalprice" class="modal modal-fixed-footer" style="height: 425px;">
        <form action="{{ url('admin/editPrice') }}" method="POST">
            <div class="modal-content">
                <h4>Edit Price</h4>
                <input type="hidden" id="editid" name="id" placeholder="" required>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="text" name="price_chat" id="editprice_chat" placeholder="" required>
                    <label for="simpletext-input">Price Chat</label>
                </div>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="text" name="price_voice" id="editprice_voice" placeholder="" required>
                    <label for="simpletext-input">Price Voice</label>
                </div>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="text" name="price_video" id="editprice_video" placeholder="" required>
                    <label for="simpletext-input">Price Video</label>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            </div>
            <div class="modal-footer">
                <button type="submit" class="modal-action waves-effect waves-green btn-flat ">UPDATE</button>
            </div>
        </form>
    </div>
    <div id="makeeditdoctor" class="modal modal-fixed-footer" style="height: 425px;">
        <form action="{{ url('admin/editDoctor') }}" method="POST">
            <div class="modal-content">
                <h4>Edit Doctor</h4>
                <input type="hidden" id="editdid" name="ids" placeholder="" required>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="text" name="fname" id="editfname" placeholder="" required>
                    <label for="simpletext-input">First Name</label>
                </div>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="text" name="lname" id="editlname" placeholder="" required>
                    <label for="simpletext-input">Last Name</label>
                </div>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="text" name="demail" id="editemail" placeholder="" required>
                    <label for="simpletext-input">Email Address</label>
                </div>
                <div class="input-field informatic-input col s12">
                    <input class="validate" type="password" name="password" id="editpassword" placeholder="" required>
                    <label for="simpletext-input">Reset Password</label>
                </div>
                <input type="hidden" value="{{ csrf_token() }}" name="_token">
            </div>
            <div class="modal-footer">
                <button type="submit" class="modal-action waves-effect waves-green btn-flat ">UPDATE</button>
            </div>
        </form>
    </div>
    <input id="saveid" type="hidden">

@endsection

@section('js')
    <script>
        $('.linkprofile').on('click', function () {
            var id = $(this).find('input').val();
            $('.showphoto').hide();
            $('.bigphoto').removeClass('showphoto');
            $(id).addClass('showphoto');
            $(id).show();
        });
        $('.makemodalprice').on('click', function () {
            $('#editid').val($(this).next().val());
            $('#editprice_chat').val($(this).next().next().val());
            $('#editprice_voice').val($(this).next().next().next().val());
            $('#editprice_video').val($(this).next().next().next().next().val());
        });
        $('.makeeditdoctor').on('click', function () {
            $('#editdid').val($(this).next().val());
            $('#editfname').val($(this).next().next().val());
            $('#editlname').val($(this).next().next().next().val());
            $('#editemail').val($(this).next().next().next().next().val());
            $('#editpassword').val('');
        });
        $('.modal').modal();
        $('.declinedoctor').on('click', function () {
            var id = $(this).next('input').val();
            $(this).addClass("declineapproved");
            $('#saveid').val(id);
            $.ajax({
                type: 'post',
                url: '/admin/declinedoctor',
                data: {
                    "doctor_id": $('#saveid').val(),
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (data) {
                    $('.declineapproved').removeClass('declinedoctor');
                    $('.declineapproved').text('Declined');
                },
                failure: function () {
                }
            });
        });
        $('.resetBalance').on('click', function () {
            var id = $(this).next('input').val();
            $('#saveid').val(id);
            $.ajax({
                type: 'post',
                url: '/admin/balancedoctor',
                data: {
                    "doctor_id": $('#saveid').val(),
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (data) {

                },
                failure: function () {
                }
            });
        });
    </script>
@endsection
