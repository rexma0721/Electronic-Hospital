@extends('layouts.apppatient')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/key_white.png')}}" alt="..." style="width:30px;">  ﺗﻐﻴﻴﺮ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ</h2>
                    </div>
                    <?php if($error != 'no'){?>
                    <form class="tabDetailCol" method="POST" action="{{url('ppassword')}}" id="updatepasswordform" >
                      @csrf
                      <div class="formInfo pdCol" style="max-width:unset;">
                        <h3 class="tabTitle" style="color:red;">{{$error}}</h3>
                        <style>
                          .rowCol .formStyle input {
                            background: #F5F7ED;
                            border: 1px solid #E9E9E9;
                            box-sizing: border-box;
                            border-radius: 8px;
                            height: 80px;
                            padding-right: 10px !important;
                          }
                        </style>
                        <div class="row rowCol">
                          <div class="col-md-9">
                            <div class="form-group">
                                <div class="formStyle inputIcol bothSideIcon">
                                    <input type="password" class="form-control" name="current" id="myFunction1" required placeholder="ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺍﻟﺤﺎﻟﻴﺔ">
                                    <div  onclick="myFunction1()">
                                        <img src="{{asset('addbyme/images/eye-show.svg')}}" alt="..." class="InputIcon" style="left: 20px;right: auto;">
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-3"></div>
                          <div class="col-md-9">
                            <div class="form-group">
                                <div class="formStyle inputIcol bothSideIcon">
                                    <input type="password" class="form-control" name="new" id="myFunction2" required placeholder="ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺍﻟﺠﺪﻳﺪﺓ">
                                    <div  onclick="myFunction2()">
                                        <img src="{{asset('addbyme/images/eye-show.svg')}}" alt="..." class="InputIcon iconRight" style="left: 20px;right: auto;">
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="col-md-3"></div>
                          <div class="col-md-9">
                            <div class="form-group">
                                <div class="formStyle inputIcol bothSideIcon">
                                    <input type="password" class="form-control" id="myFunction3" required placeholder="ﺗﺄﻛﻴﺪ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺍﻟﺠﺪﻳﺪﺓ">
                                    <div  onclick="myFunction3()">
                                        <img src="{{asset('addbyme/images/eye-show.svg')}}" alt="..." class="InputIcon iconRight" style="left: 20px;right: auto;">
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="tabBtn" style="margin-top: 0px; margin-right:30px;">
                          <button class="btn btnStyle btn_primarySecond" style="color: #FFFFFF;background: #336DC4;border-radius: 8px;">ﺗﺄﻛﻴﺪ ﺗﻐﻴﻴﺮ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ</button>
                        </div>
                      </div>
                    </form>
                    <?php }else {?>
                          <div class="tabDetailCol row" style="text-align:center;">
                              <div class="col-md-2">
                              </div>
                              <div class="col-md-8">
                              <div style="padding:30px;background-color:#FDFDFD;border: 1px solid #E9E9E9;box-sizing: border-box;border-radius: 38px;">
                              <img src="{{asset('addbyme/images/afterchangepassword.png')}}"></br></br>
                              ﺗﻢ ﺗﻐﻴﻴﺮ ﻛﻠﻤﺔ ﺍﻟﻤﺮﻭﺭ ﺑﻨﺠﺎﺡ
                              </div>
                              </div>
                              <div class="col-md-2">
                              </div>
                          </div>
                    <?php }?>
                  </div>
                </div>
                </div>
              </div>
@endsection
@section('jscontent')
    <script>
        $('#updatepasswordform').submit(function(){
            if($('#myFunction2').val() == $('#myFunction3').val())
                return true;
            alert('الرمز السري الذي تم ادخاله مختلف، يرجى التأكد منه والمحاولة مرة أخرى');
            return false;
        });
        setInterval(function(){
                $.ajax({
                    type: "GET",
                    url: '/getpunreadmessage',
                    success: function(data){
                        $('.unreadcount').text(data);
                    }
                });
    },3000);  
    </script>
@endsection
