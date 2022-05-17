@extends('layouts.apppatient')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/profile_white.png')}}" alt="...">  ﺍﻟﻤﻠﻒ ﺍﻟﺸﺨﺼﻲ</h2>
                    </div>
                    <form class="tabDetailCol" method="POST" action="{{url('pupdateprofile')}}"  enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="photo" style="display:none;">
                      <div class="formInfo pdCol">
                        <h3 class="tabTitle">بيانات الملف الشخصي</h3>
                        <div class="row rowCol">
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >الاسم الكامل</label>
                              <div class="formStyle">
                                <input type="text" class="form-control"  placeholder="" name="name" value="{{$patient->name}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >البريد الإلكتروني</label>
                              <div class="formStyle">
                                <input type="email" class="form-control"  placeholder=""  name="email" value="{{$patient->email}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >رقم الهاتف</label>
                              <div class="formStyle">
                                <input type="text" class="form-control" name="phone"  value="{{$patient->phone}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >العنوان</label>
                              <div class="formStyle">
                                <input type="text" class="form-control" name="address"  value="{{$patient->address}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group formGroup formtextarea">
                                <label >المزيد من المعلومات</label>
                                <div class="formStyle">
                                    <textarea  type="text" class="form-control"  placeholder="" required name="more_info">{{$patient->more_info}}</textarea>
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        <div class="tabBtn text-center">
                          <button class="btn btnStyle btn_primarySecond" >تحديث</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                </div>
              </div>
@endsection
@section('jscontent')
    <script>
    $('#bt_patient_image').on('click',function(){
        $('input[name="photo"]').click();
    });
    $('input[name="photo"]').on('change',function(e){
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onloadend =function(){
            $('#userimage').attr('src', reader.result);
        }
        reader.readAsDataURL(file);    
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
