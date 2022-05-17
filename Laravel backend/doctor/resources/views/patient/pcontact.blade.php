@extends('layouts.apppatient')

@section('csscontent')
@endsection
@section('content')

               <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/phone_white.png')}}" alt="..." style="width:40px;height:40px;">  ﺍﺗﺼﻞ ﺑﻨﺎ</h2>
                    </div>
                    <div class="tabDetailCol" style="padding:5px;">
                      <div class="tableSecTab" style="padding:5px;">
                          <?php if($statusone == 'start'){?>
                            <div class="table-responsive">
                                <form method="POST" action="{{url('pcontactus')}}">
                                @csrf
                                    <div style="padding:10px 0px;">
                                        <input type="text" name="title" value="patient" style="width:40%;background-color:#DEDEDE;border-radius: 10px; padding: 5px 30px;" placeholder="الاسم" hidden>
                                    </div>
                                    <div >
                                        <textarea name="message" style="height: 350px;padding:10px;width:100%;background: #F5F7ED;border: 1px solid #C5C5C5;box-sizing: border-box;border-radius: 8px;" rows="5" placeholder="نص الرسالة"></textarea>
                                    </div>
                                    <div style="text-align:center;">
                                        <input type="submit" value="ارسال" style="border:none;width:100%;padding: 10px 30px;background: #FFE380;border-radius: 8px;">
                                    </div>
                                </form>
                            </div>
                          <?php } else {?>
                            <div class=" row" style="text-align:center; padding: inherit;">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                <div style="padding:30px;background-color:#FDFDFD;border: 1px solid #E9E9E9;box-sizing: border-box;border-radius: 38px;">
                                <img src="{{asset('addbyme/images/aftermessage.png')}}"></br></br>
                                <img src="{{asset('addbyme/images/aftermessagetext.png')}}"> ﺗﻢ ﺍﺳﺘﻼﻡ ﺍﻟﺮﺳﺎﻟﺔ ﺑﻨﺠﺎﺡ
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
                </div>
              </div>
@endsection
@section('jscontent')
    <script>
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
