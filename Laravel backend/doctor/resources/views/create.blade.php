@extends('layouts.app')

@section('csscontent')
@endsection
@section('content')
    <section class="topSpace toplgSpace">
      <div class="pageContent">
        <div class="container">
          <form class="formSection" action="{{url('createdoctor')}}" id="createdoctorform" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="titleCol">
              <h3>إنشاء حساب الطبيب</h3>
            </div>
            <div class="formCol">
              <div class="uploadSec fileback1">
                <div class="uploadFile">
                  <h3>الصورة الشخصية</h3>
                  <div class="fileupload btnCol ">
                    <label>حمل الصورة</label>
                    <input type="file" class="form-control-file uploadfile1" name="photo">
                  </div>
                  <span>اختياري</span>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group formGroup">
                    <label >الاسم الاول</label>
                    <div class="formStyle">
                      <input type="text" class="form-control" required placeholder="" name="fname">
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >اللقب</label>
                    <div class="formStyle">
                      <input type="text" class="form-control" required  placeholder="" name="lname">
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >البريد الإلكتروني</label>
                    <div class="formStyle inputIcol">
                      <input type="email" class="form-control"  required placeholder="" name="email">
                      <span class="InputIcon"><img src="{{asset('addbyme/images/email.svg')}}" alt="..."></span>
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >كلمة المرور</label>
                    <div class="formStyle">
                      <input type="password" class="form-control"  required placeholder="" name="password" autocomplete="new-password">
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >التخصص</label>
                    <div class="formStyle selectOpt">
                      <select class="form-control"  required name="menulist_id">
                        <option value=""></option>
                        <?php foreach($menulists as $menulist){?>
                              <option value="{{$menulist->id}}">{{$menulist->text}}</option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >يمكنك كتابة تخصصك الدقيق</label>
                    <div class="formStyle inputIcol">
                      <input type="text" class="form-control"  required placeholder="" name="specialist">
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >سنوات الخبرة</label>
                    <div class="formStyle selectOpt">
                      <select class="form-control"  required name="experience">
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
                  <div class="form-group formGroup">
                    <label >الدرجة العلمية</label>
                    <div class="formStyle selectOpt">
                      <select class="form-control" required name="degree_id">
                        <option value=""></option>
                        <?php foreach($degrees as $degree){?>
                              <option value="{{$degree->id}}">{{$degree->text}}</option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >إضافة تخصص اخر (إن وجد)</label>
                    <div class="formStyle selectOpt">
                      <select class="form-control" name="menulist2_id">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group formGroup">
                    <label >الدولة</label>
                    <div class="formStyle selectOpt">
                      <select class="form-control" required name="country_id">
                        <option value=""></option>
                        <?php foreach($countries as $country){?>
                              <option value="{{$country->id}}">{{$country->text}}</option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >المدينة</label>
                    <div class="formStyle selectOpt">
                      <select class="form-control" required name="city_id">
                        <option value=""></option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 rightFormCol">
                  <div class="form-group formGroup">
                    <label >رقم الترخيص</label>
                    <div class="formStyle">
                      <input type="text" class="form-control" required  placeholder="" name="authorization_no">
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >رقم الهاتف المحمول (لن يعرض للعامّة)</label>
                    <div class="formStyle">
                      <input type="text" class="form-control" required  placeholder="" name="phone">
                    </div>
                  </div>
                  <div class="form-group formGroup formAddress">
                    <label >عنوان العيادة</label>
                    <div class="formStyle">
                      <textarea type="text" class="form-control" required  placeholder="" name="office_address"></textarea>
                    </div>
                  </div>
                  <div class="form-group formGroup">
                    <label >تحميل فيديو تعريفي</label>
                    <div class="form-row align-items-center">
                      <div class="col-lg-6" style="display:none;">
                        <div class="formStyle formupload fileback2">
                            <div class="fileupload">
                              <label>حمل الصورة</label>
                              <input type="file" class="form-control-file uploadfile2"  name="video_photo" placeholder="Upload photo">
                              <span><img src="{{asset('addbyme/images/uploadIcon.svg')}}" alt="..."></span>
                            </div>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="linkCol">
                          <input type="text" class="form-control"  name="video_link" placeholder="لصق رابط يوتيوب" style="text-align:right;">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="socialInput">
                    <h3>روابط التواصل الاجتماعي </h3>
                    <div class="form-group formGroup">
                      <label >صفحة الفيسبوك</label>
                      <div class="formStyle socialformStyle">
                        <input type="text" class="form-control"   name="facebook_link" placeholder="اختياري">
                        <span><img src="{{asset('addbyme/images/facebook.svg')}}" alt="..."></span>
                      </div>
                    </div>
                    <div class="form-group formGroup">
                      <label >تويتر</label>
                      <div class="formStyle socialformStyle">
                        <input type="text" class="form-control"  name="twitter_link"  placeholder="اختياري">
                        <span><img src="{{asset('addbyme/images/twitter.svg')}}" alt="..."></span>
                      </div>
                    </div>
                    <div class="form-group formGroup">
                      <label >إينستاجرام</label>
                      <div class="formStyle socialformStyle">
                        <input type="text" class="form-control"  name="instagram_link"  placeholder="اختياري">
                        <span><img src="{{asset('addbyme/images/intsagram.svg')}}" alt="..."></span>
                      </div>
                    </div>
                    <div class="form-group formGroup">
                      <label >موقع يوتيوب</label>
                      <div class="formStyle socialformStyle">
                        <input type="text" class="form-control"   name="youtube_link" placeholder="اختياري">
                        <span><img src="{{asset('addbyme/images/youtube.svg')}}" alt="..."></span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group formGroup formtextarea">
                    <label >السيرة الذاتية للطبيب</label>
                    <div class="formStyle">
                      <textarea type="text" class="form-control" required  name="doctor_cv" placeholder=""></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="btnColForm">
              <button class="btn btnStyle btn_success" href="JavaScript:void(0);">سجّل</button>
            </div>
              <input type="hidden" name="fee" value="0" id="formprice">
          </form>
        </div>
      </div>
    </section>
    <input type="hidden" id="inputmodalvalue" value="{{$fee->status}}">
    <input type="hidden" id="pricefee" value="{{$fee->price}}">
@endsection
@section('jscontent')

<script>
    $('#cardform').submit(function(){
        $('#feemodaldiv').modal('toggle');
        $.ajax({
            type:'post',
            url:'/addfee',
            data: {
                "cardnumber":  $('#card1').val()+$('#card2').val()+$('#card3').val()+$('#card4').val(),
                "exp_month":  $('#datem').val(),
                "exp_year":  $('#datey').val(),
                "cvc":  $('#cvv').val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {
                if(data == 'success')
                {
                  alert(data);
                  $('#inputmodalvalue').val('0');              
                  $('#formprice').val('1');
                  $('#createdoctorform').submit();
                }
                else
                {
                  alert(data);
                  $('#feemodal').click();
                }
            },
            failure:function(){
              alert('failed');
              $('#feemodal').click();
            }
        });
        return false;
    })
    $('#feecancel').on('click',function(){
        $('#feemodaldiv').modal('toggle');
        $('#inputmodalvalue').val('0');
        $('#createdoctorform').submit();
    })
    $('#createdoctorform').submit(function(){
      if($('#inputmodalvalue').val() == '1')
      {
        $('#priceoffee').text($('#pricefee').val());
        $('#feemodal').click();
      }
      else if($('#inputmodalvalue').val() == '0')
      {
        $('#aftercreatemodal').click();
        setTimeout(
          function() {
            $('#inputmodalvalue').val('2');
            $('#createdoctorform').submit();
          },
          4000);
      }
      else
      {
        return true;
      }
      return false;
    });
    $('.uploadfile1').on('change',function(e){
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onloadend =function(){
            $('.fileback1').attr('style', 'background-image:url(' + reader.result + ');background-size: contain;background-repeat: no-repeat;background-position: center;');
        }
        reader.readAsDataURL(file);    
    });
    $('.uploadfile2').on('change',function(e){
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onloadend =function(){
            $('.fileback2').attr('style', 'background-image:url(' + reader.result + ');background-size: contain;background-repeat: no-repeat;background-position: center;');
        }
        reader.readAsDataURL(file);    
    });
    $('select[name="menulist_id"]').on('change',function(e){
        $.ajax({
            type:'post',
            url:'/getothermenulist',
            data: {
                "menulist_id": $('select[name="menulist_id"]').val(),
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data) {                  
                var data = JSON.parse(data);
                var html='';
                $('select[name="menulist2_id"]').empty();
                html +="<option></option>"
                for(var i =0;i<data.length;i++)
                {
                    html +="<option value='" + data[i]['id']+"'>" + data[i]['text']+"</option>";
                }
                $('select[name="menulist2_id"]').append(html);
            },
            failure:function(){
            }
        });
    });
    $('select[name="country_id"]').on('change',function(e){
        $.ajax({
            type:'post',
            url:'/getcity',
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
</script>
@endsection
