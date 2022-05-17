@extends('layouts.app')

@section('csscontent')
@endsection
@section('content')
<section class="topSpace toplgSpace">
      <div class="mainpage">
        <div class="container">

            <div class="bnrlist">
              <ul>
                <li><a href="{{ url('/')}}">المتخصص<img src="{{asset('addbyme/images/arrow-right.svg')}}" alt="user" ></a></li>
                <li><a href="{{ url('/onemenulist/'.$doctor->menulist_id)}}">{{$doctor->menulist}}<img src="{{asset('addbyme/images/arrow-right.svg')}}" alt="user"></a></li>
              </ul>
            </div>
            <div class="mainDetail">
            <div class="bannrimg-sec">
              <!-- <img src="images/doctorbg2.svg" alt="doctor"> -->
            </div>
            <div class="drInfoMain">
              <div class="right-sec">
                <span style="text-align:center;margin-left:0px;">الدولة</span>
                <h6>{{$doctor->city}}</h6>
                <img src="{{asset('upload/pcode/'.$doctor->pcode)}}" class="iconMD"alt="qr-code">
              </div>
              <div class="drInfo">
                <div class="img-sec" style="    max-width: 900px;">
                  <div class="form-row align-items-end">
                    <div class="col-md-auto">
                      <div class="infoImgCol">
                        <span class="imgCircleStyle"></span>
                        <img src="{{asset('upload/photo/'.$doctor->photo)}}" alt="..." class="drImg">
                      </div>
                    </div>
                    <div class="col-md-auto position-static">
                      <div class="infoTopOptions">
                        <ul>
                          <li>
                            <div class="infoOptCol">
                              <span class="badgeTitle d-block">الدرجة العلمية</span>
                              <span class="badge badgeStyle">{{$doctor->degree}}</span>
                            </div>
                          </li>
                          <li>
                            <div class="infoOptCol">
                              <span class="badgeTitle d-block">رقم الترخيص</span>
                              <span class="badge badgeStyle">{{$doctor->authorization_no}}</span>
                            </div>
                          </li>
                          <li>
                            <div class="infoOptCol">
                              <span class="badgeTitle d-block">سنوات الخبرة</span>
                              <span class="badge badgeStyle">{{$doctor->experience}}</span>
                            </div>
                          </li>
                        </ul>
                      </div>
                     <div class="drInfoCol">
                       <ul>
                         <li><span class="drName"><img src="{{asset('addbyme/images/checkIcon.svg')}}" alt="checkIcon" class="ml-1">  الطبيب. {{$doctor->fname}} {{$doctor->lname}}</span></li>
                         <li><span class="badge badgeStyle">{{$doctor->menulist}}</span></li>
                         <li><span class="badge badgeStyle">{{$doctor->specialist1}}</span></li>
                       </ul>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="halfCircle"></div>
            <div class="qst-sec spaceCol">
              <div class="p-rl">
                <div class="row align-items-center">
                <div class="col-lg-8">
                  <div class="qst-content titleHead">
                    <h5><img src="{{asset('addbyme/images/greenCircle.svg')}}" alt="greenCircle">اونلاين وعلى استعداد للرد على أسئلتك</h5>
                    <div class="addbtn" style="direction: initial;">
                      <a href="JavaScript:void(0)" class="btn btnStyle btn_primary">أضف إلى المفضلة </a>
                      <img src="{{asset('addbyme/images/star.svg')}}" class="starIon" alt="star">
                    </div>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="startbtn text-lg-right">
                    <a href="JavaScript:void(0)" class="btn btnStyle btn_success">ابدأ بسؤال الطبيب <img src="{{asset('addbyme/images/right-arrow.svg')}}" class="rgtArrow" alt="right-arrow"> </a>
                  </div>
                </div>
              </div>
              </div>
            </div>
            <div class="about-sec">
              <div class="form-row">
                <div class="col-lg-6">
                  <div class="colRow lightgray_bg">
                    <div class="introLink">
                      <span><img src="{{asset('addbyme/images/semicoln.svg')}}" alt="..."></span>حول الدكتور
                    </div>
                    <div class="cvText">
                      <textarea tyle="text" readonly>{{$doctor->doctor_cv}}</textarea>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="colRow darkgray_bg">
                    <div class="introLink">
                      <span><img src="{{asset('addbyme/images/play-button.svg')}}" alt="..."></span>المقدمة
                    </div>
                    <div class="cvText">
                        <iframe  src="https://www.youtube.com/embed/{{ $doctor->video_link }}"></iframe>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="serviceTyp-sec">
              <div class="serviceContent">
                <div class="servicehead borderCOL titleHead">
                  <h5>محادثة كتابية</h5>
                </div>
                <div class="p-rl">
                  <div class="row">
                  <div class="col-lg-6">
                    <div class="consultTxt spaceCol">
                      <span>تحدث مع الطبيب كتابة</span>
                      <p>
                      تحدث إلى طبيبك بسهولة ، لديك الفرصة للتحدث مع الطبيب حول موضوع محدد والمتخصص مسؤول عن الإجابة عن سؤالك. الحد الأقصى لوقت استجابة الطبيب هو 10 ساعات بعد بدء المحادثة.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end">
                    <div class="consultbtn-sec spaceCol">
                      <ul>
                        <li><span>${{$doctor->price_chat}}</span></li>
                        <li>
                          <a href="JavaScript:void(0)" class="btn btnStyle btn_success">بدء الاستشارة التخصصية <img src="{{asset('addbyme/images/right-arrow.svg')}}" class="rgtArrow left-spac" alt="right-arrow"> </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
              </div>

              <div class="telephoneContent">
                <div class="servicehead titleHead">
                  <h5>محادثة صوتية</h5>
                </div>
                <div class="p-rl">
                  <div class="row">
                  <div class="col-lg-6">
                    <div class="consultTxt spaceCol">
                      <p>
                      سيقوم الطبيب عن مدة لا تزيد عن 3 ساعات بالاتصال بك والحد الأقصى 15 دقيقة لإجراء محادثة
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end">
                    <div class="consultbtn-sec">
                      <ul>
                        <li><span>${{$doctor->price_voice}}</span></li>
                        <li>
                          <a href="JavaScript:void(0)" class="btn btnStyle btn_success">بدء الاستشارة التخصصية <img src="{{asset('addbyme/images/right-arrow.svg')}}" class="rgtArrow left-spac" alt="right-arrow"> </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="telephoneContent">
                <div class="servicehead titleHead">
                  <h5>محادثة فيديو</h5>
                </div>
                <div class="p-rl">
                  <div class="row">
                  <div class="col-lg-6">
                    <div class="consultTxt spaceCol">
                      <p>
                      سيقوم الطبيب عن مدة لا تزيد عن 3 ساعات بالاتصال بك والحد الأقصى 15 دقيقة لإجراء محادثة
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center justify-content-center justify-content-lg-end">
                    <div class="consultbtn-sec">
                      <ul>
                        <li><span>${{$doctor->price_video}}</span></li>
                        <li>
                          <a href="JavaScript:void(0)" class="btn btnStyle btn_success">بدء الاستشارة التخصصية <img src="{{asset('addbyme/images/right-arrow.svg')}}" class="rgtArrow left-spac" alt="right-arrow"> </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <div class="gurantee-sec">
              <div class="guranteehead titleHead">
                <h5><img src="{{asset('addbyme/images/thumb.svg')}}" alt="thumb" class="mr-3">ضمان جودة الاستشارة الطبية</h5>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="guranteeContent">
                    <div class="imgcol">
                      <img src="{{asset('addbyme/images/user.svg')}}" class="iconbig" alt="user">
                    </div>
                    <h6>المستشار المختص معتمد وموثّق</h6>
                    <p>جميع المتخصصين موثّقين بدقّة تامة</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="guranteeContent">
                    <div class="imgcol">
                      <img src="{{asset('addbyme/images/lock.svg')}}" class="iconbig" alt="lock">
                    </div>
                    <h6>ضمان الخصوصية 100 ٪</h6>
                    <p>محادثتك مع المتخصص محمية بالكامل</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="guranteeContent">
                    <div class="imgcol">
                      <img src="{{asset('addbyme/images/result.svg')}}" class="iconbig" alt="result">
                    </div>
                    <h6>النتيجة مضمونة </h6>
                    <p>إذا لم تكن راضيًا عن الاستشارة، نضمن استرداد مبلغ الاستشارة</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="contact-sec spaceCol">
              <div class="contactInn">
                <div class="row">
                  <div class="col-lg-9">
                    <div class="contactcol">
                      <span><img src="{{asset('addbyme/images/service.svg')}}" class="" alt="service"><strong>إذا كان لديك أي مشكلة في استخدام خدماتنا ، يرجى الاتصال بنا على</strong><br> خدمتنا هي على مدار اليوم 24/7</span>
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="contctbtn text-lg-right">
                      <a href="JavaScript:void(0)" class="btn btnStyle btn_danger"><img src="{{asset('addbyme/images/call-answer.svg')}}" class="iconSM" alt="call-answer">0798234236 </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection
@section('jscontent')

<script>

</script>
@endsection
