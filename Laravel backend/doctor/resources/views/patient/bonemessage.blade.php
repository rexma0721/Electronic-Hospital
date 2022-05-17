@extends('layouts.apppatient')

@section('csscontent')
<style>
    .chatone{
        border: 0;
        padding: 10px 20px 10px 20px;
        border-radius: 5px;
        max-inline-size: min-content;
        min-width:70%;
        font-size:18px;
        color:#117E3D;
        background-color:#eef7e9; 
        box-shadow: -8px 8px 15px -5px #b8b8b8;
        font-family: Iransansweb, sans-serif;
        font-size: 20px;
        font-weight: 400;
        color: #333;
    }
    .chattwo{
        border: 0;
        padding: 10px 20px 10px 10px;
        border-radius: 5px;
        max-inline-size: min-content;
        min-width:70%;
        font-size:18px;
        color:#18468B;
        background-color:white; 
        box-shadow: 1px 1px 3px 0 #dfdfdf;
        font-family: Iransansweb, sans-serif;
        font-size: 20px;
        font-weight: 400;
        color: #333;
    }
    </style>
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/message_white.png')}}" alt="..." style="width:40px;height:40px;">   ﺍﺳﺘﺸﺎﺭﺓ ﻛﺘﺎﺑﻴﺔ</h2>
                    </div>
                    <div class="row" style="padding:10px 30px;">
                        <div class="col-md-2 col-5" style="display:flex">
                        <img src="{{asset('upload/photo/doctor.png')}}" alt="..." style="border-radius:100%;width:70px;height:70px;    border-style: ridge;">
                        <img src="{{asset('addbyme/images/verified.png')}}" alt="..." width="20px" height="20px" style="margin-right: 10px;margin-top: 10px;">
                        </div>
                        <div class="col-md-10 col-7" style="padding:inherit">Haydar Jomaa </br>Dentist  </div>
                    </div>
                    <div class="tabDetailCol" style="border-bottom: black;padding: 20px; background-color:#fafafa;     max-height: 800px;overflow-y: scroll;overflow-x: hidden;direction: ltr;" id="sliberbox">
                    <div class="row" style="direction: rtl;" id="chatbox">
                    
                        <div class="col-md-12">
                            <p class="chatone">
                            ﻳﻤﻜﻨﻚ ﺍﺭﺳﺎﻝ ﺳﺆﺍﻟﻚ ﺍﻵﻥ ﻭﺗﻔﺎﺻﻴﻞ ﺣﺎﻟﺘﻚ</br><span style="font-size: small;color: rgba(51, 51, 51, 0.49);">2020-05-14 09:37:53
                            <img src="{{asset('addbyme/images/unread.png')}}" width="17px" alt="...">
                            </br>
                            </span></p>
                        </div>
                        <div class="col-md-12">
                            <p class="chatone">
                            ﻛﻤﺎ ﻳﻤﻜﻨﻚ ﺍﺭﺳﺎﻝ ﺍﻟﻤﻠﻔﺎﺕ ﺍﻭ ﺻﻮﺭﺓ</br><span style="font-size: small;color: rgba(51, 51, 51, 0.49);">2020-05-14 09:37:53
                            <img src="{{asset('addbyme/images/unread.png')}}" width="17px" alt="...">
                            </br>
                            </span></p>
                        </div>
                        <div class="col-md-12" style="direction: ltr;">
                            <p class="chattwo" >
                            ﻳﻤﻜﻨﻚ ﺍﺭﺳﺎﻝ ﺳﺆﺍﻟﻚ ﺍﻵﻥ ﻭﺗﻔﺎﺻﻴﻞ ﺣﺎﻟﺘﻚ</br><span style="font-size: small;color: rgba(51, 51, 51, 0.49);">2020-05-14 09:37:53
                            <img src="{{asset('addbyme/images/unread.png')}}" width="17px" alt="...">
                            </br>
                            </span></p>
                        </div>
                        <div class="col-md-12" style="direction: ltr;">
                            <p class="chattwo">
                            ﻛﻤﺎ ﻳﻤﻜﻨﻚ ﺍﺭﺳﺎﻝ ﺍﻟﻤﻠﻔﺎﺕ ﺍﻭ ﺻﻮﺭﺓ</br><span style="font-size: small;color: rgba(51, 51, 51, 0.49);">2020-05-14 09:37:53
                            <img src="{{asset('addbyme/images/unread.png')}}" width="17px" alt="...">
                            </br>
                            </span></p>
                        </div>
                    </div>
                    </div>
                    <input type="file" name="photo" style="display:none;"  data-input="false"  data-size="sm" data-badge="false"  accept="image/*">
                    <div class="tabDetailCol row" style="border-bottom: black;padding: 20px;">
                        <div class="col-md-2 col-12">
                            <div class="formStyle" style="display:flex">
                                <img src="{{asset('addbyme/images/voicecall.png')}}" width="40px" height="40px" alt="..." id="voicecall" style="margin-left:10px;">
                                <img src="{{asset('addbyme/images/sendmessage.png')}}" width="40px" height="40px" alt="..." id="sendmessage" style="margin-left:10px;">
                            </div>
                        </div>
                        <div class="col-md-10 col-12">
                            <div class="formStyle">
                                <a id="bt_patient_image" style="position: absolute; top: 5px; left: 5px;"><img src="{{asset('addbyme/images/attach.png')}}" width="40px" alt="..." ></a>
                                <textarea  class="form-control"  placeholder="" name="name" placeholder="Text" required style="height:50px;font-size:18px;padding-left:50px;border-radius:5px;padding-top: 10px;border-radius: 5px;border: solid 2px #c7c7c7;" id="messagetext"></textarea>
                            </div>
                        </div>
                        <div class="col-md-8 col-12"style="margin-top: 20px;">
                            <div class="formStyle">
                                <input type="input" class="form-control" id="filename"  placeholder=""required readonly style="height:50px;font-size:18px;padding-left:50px;border-radius:5px;padding-top: 10px;border-radius: 5px;border: solid 2px #c7c7c7;">
                            </div>
                        </div>
                        <div class="col-md-4 col-12" style="margin-top: 20px;">
                            <div class="formStyle">
                            <a id="btn_end_consulting" data-toggle="modal" data-target="#testmodal3" class="form-control text-center"  placeholder="" name="name" value="" required style="padding-top: 10px;background-color:#3898EC;font-size:20px;border:none;height:50px;border-radius:5px;color:white"><p>ﺍﻧﻬﺎﺀ ﺍﻻﺳﺘﺸﺎﺭﺓ</p></a>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
    <?php if($statusone == 'good'){?>
    <a data-toggle="modal" data-target="#addmoneymodaldiv" data-backdrop="static" data-keyboard="false" id="addmoneymodal" style="display:none;"></a>
    <div class="modal fade sign-in-modal3 rounded-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addmoneymodaldiv">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="content-box">
              <div class="checkCol">
                <img src="{{asset('addbyme/images/warning.png')}}" alt="...">لا يوجد لديك رصيد كاف يرجى اضافة ر
              </div>
              <div class="appDetail" style="background:none;">
                <div class="appInfoCol">
                  <div class="appCol">
                    <a href="{{url('/addmoney')}}" style="background-color:#1955A5;padding:10px;border-radius: 20px;color:white;">
                        <img src="{{asset('addbyme/images/addmoney.png')}}">اضافة رصيد
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php }?>
    <?php if($statusone == 'bad'){?>
    <a data-toggle="modal" data-target="#addmoneymodaldiv" data-backdrop="static" data-keyboard="false" id="addmoneymodal" style="display:none;"></a>
    <style>
    .voicecall_modal {
        width:500px;
    }
    @media (max-width: 500px) {
      .voicecall_modal {
        width:100%;
      }
    }
    </style>
    <div class="modal fade sign-in-modal3 rounded-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addmoneymodaldiv">
        <div class="modal-dialog modal-lg">
          <div class="modal-content voicecall_modal">
            <div class="content-box">
              <div class="checkCol">
                <img src="{{asset('addbyme/images/warning.png')}}" alt="..."><span>  ﻋﺬﺭﺍ ﺳﻴﺘﻢ ﻗﺮﻳﺒﺎ ﺗﻔﻌﻴﻞ ﺧﺎﺻﻴﺔ ﺍﻻﺗﺼﺎﻝ ﺑﺎﻟﻄﺒﻴﺐ ﺑﺎﻟﺼﻮﺕ ﻭﺍﻟﺼﻮﺭﺓ</span>
              </div>
              <div class="appDetail" style="background:none;">
                <div class="appInfoCol">
                  <div class="appCol">
                    <a href="{{ url('/ponedoctor/'.$id)}}" style="background-color:#1861CE;padding:20px;border-radius: 20px;color:white;vertical-align: middle;height: 60px;width: 150px;margin-left: 20px;">Back</a>
                    <a href="{{ url('/createmessage/'.$id)}}" style="background-color:#00A68C;padding:10px;border-radius: 20px;color:white;">
                        <img src="{{asset('addbyme/images/message.png')}}"> ﺍﺳﺄﻝ ﺍﻟﻄﺒﻴﺐ ﻛﺘﺎﺑﺔ
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php }?>
@endsection
@section('jscontent')
    <script>
    $('#addmoneymodal').click();
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

