
@extends('layouts.app')
@section('csscontent')
@endsection
@section('content')

  <!-- bannerSection starts -->
  <section class="topSpace toplgSpace">

    <div class="bannerDiv">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="bannerImg">
              <img src="{{asset('addbyme/images/banner_img-2.svg')}}" alt="bannerImg">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="bannerCont blackText ml-auto">
              <h4>في أي وقت, وفي أي مكان اسأل واستشر أفضل الأطباء الأخصائيين الموثقين</h4>
            </div>
            <div class="bannerCont ml-auto" style="padding-top: 25px;">
                <div class="appCol">
                <a href="Javascript:void(0)">
                    <img src="{{asset('addbyme/images/android.svg')}}" alt="android">
                </a>
                <a href="Javascript:void(0)">
                    <img src="{{asset('addbyme/images/ios.svg')}}" alt="ios">
                </a>
                </div>
            </div>
          </div>
        </div>
        <div class="serviceCol">
          <div class="row">
            <div class="col-lg-7">
              <div class="consultCol blackText">
                <h2>خدمة الاستشارة الطبيّة الألكترونية</h2>
                <ul>
                  <li>
                    <div class="consultCont">
                      <img src="{{asset('addbyme/images/doctor_img.svg')}}" alt="doctorimg" style="transform: inherit;">
                      <p>اختر الطبيب</p>
                    </div>
                  </li>
                  <li>
                    <div class="consultCont">
                      <img src="{{asset('addbyme/images/right-arrrow.svg')}}" alt="right-arrow">
                    </div>
                  </li>
                  <li>
                    <div class="consultCont">
                      <img src="{{asset('addbyme/images/mobile.svg')}}" alt="mobile" style="transform: inherit;">
                      <p>بدء المحادثة</p>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-5">
              <img src="{{asset('addbyme/images/consult-img.svg')}}" alt="consult">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- bannerSection Ends -->

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
                  <?php foreach($menulists as $menulist){?>
                  <option value="{{$menulist->id}}">{{$menulist->text}}</option>
                  <?php }?>
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
                    <a href="{{ url('/onedoctor/'.$doctor->id)}}">
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
@endsection
@section('jscontent')
    <script src="{{asset('addbyme/js/slick.min.js')}}"></script>
    <script src="{{asset('addbyme/js/slidermy.js')}}"></script>
    <script>
      $('#menulistselect').on('change',function(){
          var href = $('#onemenulista').attr('href');
          window.location.replace(href + '/' +$(this).val());
      })
    </script>
@endsection
