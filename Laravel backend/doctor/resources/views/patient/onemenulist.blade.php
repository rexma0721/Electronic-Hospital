@extends('layouts.apppatientone')

@section('csscontent')
@endsection
@section('content')
    <!-- consultation service starts -->
    <section class="topSpace">
      <div class="consultationCol">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-7">
              <div class="consultbanner">
                <h1>خدمة الاستشارة الطبيّة</h1>
                <div class="bannerCont whiteText bannermargin">
                  <h4>بأفضل التكاليف ، في أي وقت في أي مكان ، مع أفضل الأخصائيين الموثقين</h4>
                </div>
                <div class="startConsultbtn">
                  <a class="btn btnStyle btn_danger customBtn" href="Javascript:void(0);">بدء المحادثة <span class="downCircle"><img src="{{asset('addbyme/images/down-arrow.svg')}}" alt="down_arrow"><span></a>
                </div>
              </div>
            </div>
            <div class="col-md-5">
              <img src="{{asset('addbyme/images/consult-img.svg')}}" class="consultImg" alt="consult">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- consultation service starts -->


    <!-- menuLsit Section starts -->
      <section>
        <div class="menuListDiv">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="menuListTitle">
                  <h4>الأطباء المتخصصين في مجال {{$cmenulist->text}}</h4>
                </div>
              </div>
            </div>
            <?php $i = 1;foreach($doctors as $doctor){ if($doctor->menulist_id == $menulist_id){?>
            <div class="row cardtopSpace">
              <div class="col-md-12">
                <div class="doctorCardStyle">
                  <div class="row ">
                    <div class="col-lg-auto col-sm-12 d-flex align-items-center">
                      <div class="doctorImg">
                        <img src="{{asset('upload/photo/'.$doctor->photo)}}" alt="dr_james" style="width:166px;height:166px;border-radius: 100%;">
                      </div>
                    </div>
                    <div class="col">
                      <div class="cardInnerCont">
                        <div class="row justify-content-lg-between">
                          <div class="col-lg-4 col-sm-12">
                            <div class="doctorInfo">
                              <ul>
                                <li><img src="{{asset('addbyme/images/blue_tick.png')}}" alt="blueTick"><span class="doctorName">الطبيب {{$doctor->fname}} {{$doctor->lname}}</span></li>
                                <li>{{$doctor->menulist}}</li>
                                <li>{{$doctor->specialist1}}</li>
                              </ul>
                            </div>
                          </div>
                          <div class="col-lg-4 col-sm-12">
                            <div class="details">
                              <h4>الدرجة العلمية</h4>
                              <p>{{$doctor->degree}}</p>
                            </div>
                          </div>
                          <div class="col-lg-4 col-sm-12">
                            <div class="details">
                              <h4>رقم الترخيص</h4>
                              <p>{{$doctor->authorization_no}}</p>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-11 col-12">
                          <div class="moreDetailBtn">
                            <a class="btn btnStyle btnstyleSecondary" href="{{ url('/ponedoctor/'.$doctor->id)}}">المزيد من التفاصيل </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }}?>
          </div>
        </div>
      </section>
    <!-- menuLsit Section starts -->

    <!-- healthIssue section starts -->
      <section class="div healtCol">
        <div class="container">
          <div class="row">
            <div class="col">
              <div class="healthList">
                <ul>
                  <li>اسأل واستشر الأطباء المتخصصين في مجال {{$cmenulist->text}}</li>
                  <?php foreach($definitions as $definition){?>
                  <li style="font-size:20px;">-{{$definition->text}}</li>
                  <?php }?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- healthIssue section ends -->

    <!-- onlineConsultation section starts -->
    <section>
      <div class="onlineConsultDiv">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="titleCol row">
                <div class="col-md-6">
                  <h2>استشارة طبية عبر الإنترنت</h2>
                </div>
                <div class="col-md-6" style="text-align:left;margin: 10px 0px;" id="menulistsel">
                  <select id="menulistselect" style="height: 100%;border-radius: 10px; font-size: 25px; background-color: #F7F7F7;padding:5px 10px;">
                    <option>أختر الأطباء في قسم</option>
                    <?php foreach($menulists as $menulist){ if($menulist->id != $cmenulist->id){?>
                    <option value="{{$menulist->id}}">{{$menulist->text}}</option>
                    <?php }}?>
                  </select>
                </div>
                <h4>أكثر من <span class="pinkText">{{$ndoctor}} طبيب</span> في <span class="pinkText">{{$nspecialist}} تخصص</span> مستعدون لتقديم الاستشارة الطبية التخصصية</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- onlineConsultation section starts -->
    <a href="{{ url('/onemenulist/')}}" id="onemenulista"></a>
    <!-- slideerSection starts -->
    <div class="sliderDiv">
    <div class="container">
      <?php $i = 1;foreach($menulists as $menulist){
         $c = 0; foreach($doctors as $doctor){if($doctor->menulist_id == $menulist->id){$c++;}}
         if($c != 0 ){?>
        <div class="sliderCol">
          <div class="row align-items-center slideBg">
            <div class="col-md-5">
              <div class="slidetext">
              <a href="{{ url('/onemenulist/'.$menulist->id)}}"><h3>اسأل واستشر الطبيب المختص في <span style="background: #007bff;color: white;padding: 1px 5px;border-radius: 10%;">{{$menulist->text}}</span> </h3></a>
              </div>
            </div>
            <div class="col-md-7 col-sm-12">
              <div class="slideCol">
                <div class="slider slider-{{$i}}">
                  <?php foreach($doctors as $doctor){
                          if($doctor->menulist_id == $menulist->id){?>
                  <div class="slideImg">
                    <a href="{{ url('/ponedoctor/'.$doctor->id)}}">
                        <img src="{{asset('upload/photo/'.$doctor->photo)}}" alt="slide_img">
                    </a>
                  </div>
                  <?php }}?>
                </div>
                <div class="sliderArrows">
                  <ul>
                    <li class="prev prev-{{$i}}"><i class="fa fa-angle-right" aria-hidden="true"></i></li>
                    <li class="next next-{{$i}}"><i class="fa fa-angle-left" aria-hidden="true"></i></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php $i++;}}?>
    </div>
  </div>
      <!-- slideerSection starts -->

    <!-- WhyUs Section starts -->
      <section>
        <div class="whyUsCol">
          <div class="container">
            <div class="row">
              <div class="col-12">
                <div class="whyusHeading">
                  <h3>لماذا نحن؟</h3>
                </div>
              </div>
            </div>
            <div class="serviceCategory">
              <div class="row">
                <div class="col-md-3">
                  <div class="querySection">
                    <img src="{{asset('addbyme/images/medical.svg')}}" class="queryImg" alt="medical">
                    <h3>إرسال المستندات الطبية الخاصة بك</h3>
                    <p>يمكنك إرسال جميع النتائج الطبية الخاصة بك على الإنترنت إلى الطبيب مباشرة</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="querySection">
                    <img src="{{asset('addbyme/images/connnect.svg')}}"  class="queryImg" alt="connnect">
                    <h3>يتم ايصالك مع الطبيب مباشرة</h3>
                    <p>الطبيب جاهز لتقديم الاستشارة من خلال تطبيق معين</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="querySection">
                    <img src="{{asset('addbyme/images/money.svg')}}"  class="queryImg" alt="money">
                    <h3>ضمان استعادة مبلغ الاستشارة</h3>
                    <p>إذا لم تكن راضيًا ، فيمكنك استرجاع المبلغ  </p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="querySection">
                    <img src="{{asset('addbyme/images/free.svg')}}"  class="queryImg" alt="free">
                    <h3>إعادة توجيه الطبيب مجانا</h3>
                    <p>يمكنك اختيار مستشار آخر إذا لم تكن راضيًا</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-auto">
                <img src="{{asset('addbyme/images/headphone.svg')}}" alt="headphone">
              </div>
              <div class="col-md-auto">
                <div class="serviceText">
                  <h3>إذا كان لديك أي مشكلة في استخدام خدماتنا ، يرجى الاتصال بنا على</h3>
                  <p>خدمتنا هي على مدار اليوم 24/7</p>
                </div>
              </div>
              <div class="col">
                <div class="serviceBtn">
                  <a class="btn btnStyle btn_danger" href="JavaScript:void(0);"><img src="{{asset('addbyme/images/phoneicon.svg')}}" alt="phoneicon">  0798234236</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- WhyUs Section ends -->
@endsection
@section('jscontent')

<script src="{{asset('addbyme/js/slick.min.js')}}"></script>
<script src="{{asset('addbyme/js/slidermy.js')}}"></script>
<script>
      $('#menulistselect').on('change',function(){
          var href = $('#onemenulista').attr('href');
          window.location.replace(href + '/' +$(this).val());
      })
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
