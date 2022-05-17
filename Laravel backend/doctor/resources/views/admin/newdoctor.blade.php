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
                    <?php $g = 1;$k=1;foreach($doctors as $doctor){?>
                        <div class="row linkprofile">
                            <input type="hidden" value="#profile{{$g}}">
                            <div class="col m3">
                                <img src="{{asset('upload/photo/'.$doctor->photo)}}" style="width:50px;height:50px;border-radius: 100%;">
                            </div>
                            
                            <div class="col m9">
                                <p>{{$doctor->fname}} {{$doctor->lname}}</p>
                                <p>{{$doctor->country}} {{$doctor->city}} {{$doctor->area}}</p>
                            </div>
                        </div>
                        <?php $k=$g;$g++;}?>
                </div>
            </div>
        </div>
        <div class="col s18 m9">
            <div class="card">
                <div class="card-content">
                <?php $g =1;foreach($doctors as $doctor) {?>
                        <div class="bigphoto" id="profile{{$g}}" style="display:none">
                            <div style="padding:10px">
                                <div class="row">
                                    <div class="col m6">
                                        <span>First Name</span>
                                    </div>
                                    <div class="col m6">
                                        <span name="fname">{{$doctor->fname}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Last Name</span>
                                    </div>
                                    <div class="col m6">
                                        <span name="lname">{{$doctor->lname}}</span>
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
                                    <img src="{{asset('upload/photo/'.$doctor->photo)}}" style="width:100px;height:100px;border-radius: 100%;">
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
                                        <span  name="pnumber">{{$doctor->phone}}</span>
                                    </div>
                                </div>
                                <div style="height: 1px; background: #EFEFF4;"></div>
                                <div class="row">
                                    <div class="col m6">
                                        <span>Email</span>
                                    </div>
                                    <div class="col m6">
                                        <span  name="email">{{$doctor->email}}</span>
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
                                        <span><a href="{{$doctor->instagram_link}}">{{$doctor->instagram_link}}</a></span>
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
                                    <img src="{{asset('upload/videophoto/'.$doctor->video_photo)}}" style="width:100px;height:100px;border-radius: 10%;">
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
                            </div>
                            <div class="row">
                                <div class="col m3" style="text-align:left">
                                    <?php if($g > 1){?>
                                    <a class="waves-effect waves-light btn-large linkprofile"><i class="material-icons left">skip_previous</i>Previous Dr</a>
                                    <input type="hidden" value="#profile{{$g-1}}">
                                    <?php }?>
                                </div>
                                <div class="col m3" style="text-align:center">
                                    <a class="waves-effect waves-light btn-large green approvedoctor">Approve</a> 
                                    <input type="hidden" value="{{$doctor->id}}">
                                    <input type="hidden" value="{{$g}}">
                                </div>
                                <div class="col m3" style="text-align:center">
                                    <a class="waves-effect waves-light btn-large black declinedoctor">Decline</a> 
                                    <input type="hidden" value="{{$doctor->id}}">
                                </div>
                                <div class="col m3" style="text-align:right">
                                    <?php if($g < $k){?>
                                    <a href="#three" class="waves-effect waves-light btn-large linkprofile"><i class="material-icons right">skip_next</i>Next Dr</a>
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
<input id="saveid"  type="hidden">
<input id="profileid"  type="hidden">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/connectycube@1.7.3/dist/connectycube.min.js"></script>

<script>
    $('.linkprofile').on('click',function(){
        var id = $(this).find('input').val();
        $('.showphoto').hide();
        $('.bigphoto').removeClass('showphoto');
        $(id).addClass('showphoto');
        $(id).show();
    })
    $('.approvedoctor').on('click',function(){
        var id = $(this).next('input').val();
        var nu = $(this).next('input').next('input').val();
        $(this).addClass("doctorapproved");
        $('#saveid').val(id);
        $('#profileid').val(nu);
        $.ajax({
            type:'post',
            url:'/admin/approvedoctor',
            data: {
                "doctor_id":  $('#saveid').val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {  
                var CREDENTIALS = {
                    appId: 1764,
                    authKey: 'NKYS3UhKJFGBRBD',
                    authSecret: 'vyTE88vOSvqKemr'
                };
                var CONFIG = {
                    debug: { mode: 1 } // enable DEBUG mode (mode 0 is logs off, mode 1 -> console.log())
                };
                ConnectyCube.init(CREDENTIALS, CONFIG);

                ConnectyCube.createSession(function(error, session) {
                    var x = Math.floor((Math.random() * 100000) + 100000);
                    var userProfile = {
                        'login': x,
                        'password': "hck1234$$$",
                        'email': $('#profile'+$('#profileid').val()).find('span[name="email"]').text(),
                        'full_name': $('#profile'+$('#profileid').val()).find('span[name="fname"]').text()+' '+$('#profile'+$('#profileid').val()).find('span[name="lname"]').text(),
                        'phone': '+15841596638',
                        'website': "https://ehospital.online",
                        'tag_list': ["iphone", "apple"],
                        'custom_data': JSON.stringify({middle_name: "Bartoleo"})
                    };

                    var result = ConnectyCube.users.signup(userProfile, function(error, user){
                        console.log(user);
                        $.ajax({
                            type:'post',
                            url:'/admin/saveconnectcube',
                            data: {
                                "doctor_id":  $('#saveid').val(),
                                'login': user['login'],
                                'password': "hck1234$$$",
                                'id': user['id'],
                                "_token": $('meta[name="csrf-token"]').attr('content'),
                            },
                            success:function(data) {                  
                            },
                            failure:function(){
                            }
                        });
                    });  

                });
                
                $('.doctorapproved').removeClass('approvedoctor');
                $('.doctorapproved').text('Approved');
            },
            failure:function(){
            }
        });
    });
    $('.declinedoctor').on('click',function(){
        var id = $(this).next('input').val();
        $(this).addClass("declineapproved");
        $('#saveid').val(id);
        $.ajax({
            type:'post',
            url:'/admin/declinedoctor',
            data: {
                "doctor_id":  $('#saveid').val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {                  
                $('.declineapproved').removeClass('declinedoctor');
                $('.declineapproved').text('Declined');
                $('.declineapproved').parent('div').parent('div').find('.approvedoctor').addClass('doctorapproved');
                $('.declineapproved').parent('div').parent('div').find('.approvedoctor').hide();
                $('.doctorapproved').removeClass('approvedoctor');
            },
            failure:function(){
            }
        });
    });
</script>
@endsection
