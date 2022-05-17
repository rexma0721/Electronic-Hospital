@extends('layouts.appdoctor')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2>تعديل الملف الشخصي</h2>
                    </div>
                    <form class="tabDetailCol" method="POST" action="{{url('updateprofile')}}"  enctype="multipart/form-data">
                      @csrf
                      <input type="file" name="photo" style="display:none;">
                      <div class="formInfo pdCol">
                        <h3 class="tabTitle">بيانات الملف الشخصي</h3>
                        <div class="row rowCol">
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >الاسم الاول</label>
                              <div class="formStyle">
                                <input type="text" class="form-control"  placeholder="" name="fname" value="{{$doctor->fname}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >اللقب</label>
                              <div class="formStyle">
                                <input type="text" class="form-control"  placeholder="" name="lname" value="{{$doctor->lname}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >البريد الإلكتروني</label>
                              <div class="formStyle">
                                <input type="email" class="form-control"  placeholder=""  name="email" value="{{$doctor->email}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >رقم الهاتف</label>
                              <div class="formStyle">
                                <input type="text" class="form-control" name="phone"  value="{{$doctor->phone}}" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >التخصص</label>
                              <div class="formStyle selectOpt">
                                <select class="form-control"  name="menulist_id" required>
                                    <option value="{{$doctor->menulist_id}}">{{$doctor->menulist}}</option>
                                    <?php foreach($menulists as $menulist){?>
                                        <option value="{{$menulist->id}}">{{$menulist->text}}</option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >متخصص</label>
                              <div class="formStyle selectOpt">
                                <select class="form-control" name="specialist1_id" required>
                                    <option value="{{$doctor->specialist1_id}}">{{$doctor->specialist1}}</option>
                                    <?php foreach($specialists as $specialist){?>
                                        <option value="{{$specialist->id}}">{{$specialist->text}}</option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >الدرجة العلمية</label>
                              <div class="formStyle selectOpt">
                                <select class="form-control" name="degree_id" required>
                                    <option value="{{$doctor->degree_id}}">{{$doctor->degree}}</option>
                                    <?php foreach($degrees as $degree){?>
                                        <option value="{{$degree->id}}">{{$degree->text}}</option>
                                    <?php }?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group formGroup tabInputStyle">
                              <label >رقم الترخيص</label>
                              <div class="formStyle">
                                <input type="text" class="form-control"  value="{{$doctor->authorization_no}}" name="authorization_no" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-8">
                            <div class="form-group formGroup tabInputStyle">
                              <label >عنوان المكتب</label>
                              <div class="formStyle">
                                <input type="text" class="form-control"  value="{{$doctor->office_address}}" name="office_address" required>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group formGroup tabInputStyle">
                              <label >سنوات الخبرة</label>
                              <div class="formStyle selectOpt">
                                <select class="form-control"  required name="experience">
                                  <option value="{{$doctor->experience}}">{{$doctor->experience}}</option>
                                  <option value="1 سنة">1 سنة</option>
                                  <option value="2 سنوات">2 سنوات</option>
                                  <option value="3 سنوات">3 سنوات</option>
                                  <option value="4 سنوات">4 سنوات</option>
                                  <option value="5 سنوات">5 سنوات</option>
                                  <option value="6 سنوات">6 سنوات</option>
                                  <option value="7 سنوات">7 سنوات</option>
                                  <option value="8 سنوات">8 سنوات</option>
                                  <option value="9 سنوات">9 سنوات</option>
                                  <option value="10 سنوات">10 سنوات</option>
                                  <option value="11 سنوات">11 سنوات</option>
                                  <option value="12 سنوات">12 سنوات</option>
                                  <option value="13 سنوات">13 سنوات</option>
                                  <option value="14 سنوات">14 سنوات</option>
                                  <option value="15 سنوات">15 سنوات</option>
                                  <option value="16 سنوات">16 سنوات</option>
                                  <option value="17 سنوات">17 سنوات</option>
                                  <option value="18 سنوات">18 سنوات</option>
                                  <option value="19 سنوات">19 سنوات</option>
                                  <option value="20 سنوات">20 سنوات</option>
                                  <option value="21 سنوات">21 سنوات</option>
                                  <option value="22 سنوات">22 سنوات</option>
                                  <option value="23 سنوات">23 سنوات</option>
                                  <option value="24 سنوات">24 سنوات</option>
                                  <option value="25 سنوات">25 سنوات</option>
                                  <option value="26 سنوات">26 سنوات</option>
                                  <option value="27 سنوات">27 سنوات</option>
                                  <option value="28 سنوات">28 سنوات</option>
                                  <option value="29 سنوات">29 سنوات</option>
                                  <option value="30 سنوات">30 سنوات</option>
                                  <option value="31 سنوات">31 سنوات</option>
                                  <option value="32 سنوات">32 سنوات</option>
                                  <option value="33 سنوات">33 سنوات</option>
                                  <option value="34 سنوات">34 سنوات</option>
                                  <option value="35 سنوات">35 سنوات</option>
                                  <option value="36 سنوات">36 سنوات</option>
                                  <option value="37 سنوات">37 سنوات</option>
                                  <option value="38 سنوات">38 سنوات</option>
                                  <option value="39 سنوات">39 سنوات</option>
                                  <option value="40 سنوات">40 سنوات</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="personalInfo pdCol">
                        <div class="formInfo">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group formGroup tabInputStyle">
                                <label >الدولة</label>
                                <div class="formStyle selectOpt">
                                  <select class="form-control"  name="country_id" required>
                                    <option value="{{$doctor->country_id}}">{{$doctor->country}}</option>
                                    <?php foreach($countries as $country){?>
                                        <option value="{{$country->id}}">{{$country->text}}</option>
                                    <?php }?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group formGroup tabInputStyle">
                                <label >المدينة</label>
                                <div class="formStyle selectOpt">
                                  <select class="form-control"  name="city_id" required>
                                    <option value="{{$doctor->city_id}}">{{$doctor->city}}</option>
                                    <?php foreach($cities as $city){?>
                                        <option value="{{$city->id}}">{{$city->text}}</option>
                                    <?php }?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group formGroup formtextarea">
                          <label >السيرة الذاتية للطبيب</label>
                          <div class="formStyle">
                            <textarea  type="text" class="form-control"  placeholder="" required name="doctor_cv">{{$doctor->doctor_cv}}</textarea>
                          </div>
                        </div>
                      </div>
                      <div class="personalInfo pdCol">
                        <div class="introCol">
                          <div class="introLink">
                            <span><a href="{{$doctor->video_link}}"><img src="{{asset('addbyme/images/vedioIcon.svg')}}" alt="..."></a></span>فيديو تعريفي
                          </div>
                          <div class="linkCol">
                            <input type="text" class="form-control"  placeholder="Paste Youtube Link here"  value="{{$doctor->video_link}}" name="video_link" required>
                        </div>
                        </div>
                      </div>
                      <div class="personalInfo pdCol">
                        <h3 class="tabTitle">نوع الخدمة الاستشارية</h3>
                        <div class="serviceLinks">
                          <ul>
                            <li style="padding-right: 0px;"><input type="checkbox" name="service_chat" value="1" style="width: 30px; height: 30px;" <?php if($doctor->service_chat == '1'){echo 'checked';}?>><span style="padding-right:20px;">تواصل كتابة</span></li>
                            <li style="padding-right: 0px;"><input type="checkbox" name="service_call" value="1" style="width: 30px; height: 30px;" <?php if($doctor->service_call == '1'){echo 'checked';}?>><span style="padding-right:20px;">تواصل صوتي</span></li>
                            <li style="padding-right: 0px;"><input type="checkbox" name="service_video" value="1" style="width: 30px; height: 30px;" <?php if($doctor->service_video == '1'){echo 'checked';}?>><span style="padding-right:20px;">تواصل فيديو</span></li>
                          </ul>
                        </div>
                      </div>
                      <div class="personalInfo pdCol">
                        <div class="formInfo">
                          <div class="selectCol selectInfo">
                            <h3 class="tabTitle">ساعات العمل</h3>
                            <div class="form-row mt-1">
                              <div class="col-md-6">
                                <div class="form-row align-items-center">
                                  <div class="form-group formGroup tabInputStyle col-auto">
                                    <label >من</label>
                                  </div>
                                  <div class="form-group formGroup tabInputStyle col">
                                    <div class="formStyle">
                                      <input type="time" class="form-control"  placeholder="10:00" value="{{$doctor->work_start_time}}" name="work_start_time">
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-row align-items-center">
                                  <div class="form-group formGroup tabInputStyle col-auto">
                                    <label >حتى</label>
                                  </div>
                                  <div class="form-group formGroup tabInputStyle col">
                                    <div class="formStyle">
                                      <input type="time" class="form-control"  placeholder="10:00"  value="{{$doctor->work_end_time}}" name="work_end_time">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="selectCol mt-3 selectInfo">
                            <h3 class="tabTitle">ساعات العمل</h3>
                            <div class="form-row mt-1">
                              <div class="col-md-6">
                                <div class="form-row align-items-center">
                                  <div class="form-group formGroup tabInputStyle col-auto">
                                    <label >من</label>
                                  </div>
                                  <div class="form-group formGroup tabInputStyle col">
                                    <div class="formStyle selectOpt">
                                      <select class="form-control"  placeholder="Saturday"  name="work_start_day">
                                        <option value="{{$doctor->work_start_day}}">{{$doctor->work_start_day}}</option>
                                        <option value="الإثنين">الإثنين</option>
                                        <option value="الثلاثاء">الثلاثاء</option>
                                        <option value="الأربعاء">الأربعاء</option>
                                        <option value="الخميس">الخميس</option>
                                        <option value="الجمعة">الجمعة</option>
                                        <option value="السبت">السبت</option>
                                        <option value="الأحد">الأحد </option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-row align-items-center">
                                  <div class="form-group formGroup tabInputStyle col-auto">
                                    <label >حتى</label>
                                  </div>
                                  <div class="form-group formGroup tabInputStyle col">
                                    <div class="formStyle selectOpt">
                                      <select class="form-control"  placeholder="Saturday"  name="work_end_day">
                                        <option value="{{$doctor->work_end_day}}">{{$doctor->work_end_day}}</option>
                                        <option value="الإثنين">الإثنين</option>
                                        <option value="الثلاثاء">الثلاثاء</option>
                                        <option value="الأربعاء">الأربعاء</option>
                                        <option value="الخميس">الخميس</option>
                                        <option value="الجمعة">الجمعة</option>
                                        <option value="السبت">السبت</option>
                                        <option value="الأحد">الأحد </option>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                      <div class="personalInfo pdCol">
                        <h3 class="tabTitle">روابط وسائل التواصل الاجتماعي</h3>
                        <div class="officialLinks">
                          <div class="form-group formGroup">
                            <label >صفحة الفيسبوك</label>
                            <div class="formStyle socialformStyle">
                              <input type="text" class="form-control"  placeholder="اختياري" value="{{$doctor->facebook_link}}" name="facebook_link">
                              <span><img src="{{asset('addbyme/images/facebook.svg')}}" alt="..."></span>
                            </div>
                          </div>
                          <div class="form-group formGroup">
                            <label >تويتر</label>
                            <div class="formStyle socialformStyle">
                              <input type="text" class="form-control"  placeholder="اختياري" value="{{$doctor->twitter_link}}" name="twitter_link">
                              <span><img src="{{asset('addbyme/images/twitter.svg')}}" alt="..."></span>
                            </div>
                          </div>
                          <div class="form-group formGroup">
                            <label >إينستاجرام</label>
                            <div class="formStyle socialformStyle">
                              <input type="text" class="form-control"  placeholder="اختياري" value="{{$doctor->instagram_link}}" name="instagram_link">
                              <span><img src="{{asset('addbyme/images/intsagram.svg')}}" alt="..."></span>
                            </div>
                          </div>
                          <div class="form-group formGroup">
                            <label >موقع يوتيوب</label>
                            <div class="formStyle socialformStyle">
                              <input type="text" class="form-control"  placeholder="اختياري" value="{{$doctor->youtube_link}}" name="youtube_link">
                              <span><img src="{{asset('addbyme/images/youtube.svg')}}" alt="..."></span>
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
    
    $('select[name="menulist_id"]').on('change',function(e){
        $.ajax({
            type:'post',
            url:'/dgetspecialist',
            data: {
                "menulist_id": $('select[name="menulist_id"]').val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {                  
                var data = JSON.parse(data);
                var html='';
                $('select[name="specialist1_id"]').empty();
                $('select[name="specialist2_id"]').empty();
                html +="<option></option>"
                for(var i =0;i<data.length;i++)
                {
                    html +="<option value='" + data[i]['id']+"'>" + data[i]['text']+"</option>";
                }
                $('select[name="specialist1_id"]').append(html);
                $('select[name="specialist2_id"]').append(html);
            },
            failure:function(){
            }
        });
    });
    $('select[name="country_id"]').on('change',function(e){
        $.ajax({
            type:'post',
            url:'/dgetcity',
            data: {
                "country_id": $('select[name="country_id"]').val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {                  
                var data = JSON.parse(data);
                var html='';
                $('select[name="city_id"]').empty();
                html +="<option></option>"
                for(var i =0;i<data.length;i++)
                {
                    html +="<option value='" + data[i]['id']+"'>" + data[i]['text']+"</option>";
                }
                $('select[name="city_id"]').append(html);
            },
            failure:function(){
            }
        });
    });
    $('#bt_doctor_image').on('click',function(){
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
                    url: '/getdunreadmessage',
                    success: function(data){
                        $('.unreadcount').text(data);
                    }
                });
    },3000);  
    </script>
@endsection
