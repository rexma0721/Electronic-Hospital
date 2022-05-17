<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('addbyme/css/bootstrap-rtl.min.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('addbyme/images/favicon-32x32.png')}}">
    <link rel="stylesheet" href="{{asset('addbyme/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('addbyme/css/style-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('addbyme/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('addbyme/css/modalstyle.css')}}">
    @yield('csscontent')
    <style type="text/css">
        @font-face {
            font-family: IRAQSansWeb;
            src: url("{{asset('addbyme/fonts/IRAQSansWeb.woff2')}}");
        }
    </style>
     <style type="text/css">
        @font-face {
            font-family: IRAQSansWeb_Bold;
            src: url("{{asset('addbyme/fonts/IRAQSansWeb_Bold.woff2')}}");
        }
    </style>
     <style type="text/css">
        @font-face {
            font-family: IRAQSansWeb_Medium;
            src: url("{{asset('addbyme/fonts/IRAQSansWeb_Medium.woff2')}}");
        }
    </style>
</head>
<body style=" font-family: 'IRAQSansWeb_Bold';background-color:#f3f3f3;">
        
    <!-- headerSection starts -->
    <header>
        <div class="headerCol">
        <div class="container">
            <div class="row align-items-center">
            <div class="col-auto">
                <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('addbyme/images/logo.svg')}}" alt="..."></a>
                </div>
            </div>
            <div class="col">
                <div class="navTrigger d-block d-lg-none">
                    <span class="ml-auto navTgl">
                    <span class="tglLine tglLine1"></span>
                    <span class="tglLine tglLine2"></span>
                    <span class="tglLine tglLine3"></span>
                    </span>
                </div>
                <div class="navCol">
                    <div class="navBtns">
                    <ul>
                        <li id="navmessage">
                        <a href="{{url('/dmessage')}}">
                        <p class="unreadcount" style="width:14px;top: 3px; color:white;  position: absolute;    font-size: 11px;" ></p>
                        <img src="{{asset('addbyme/images/alert1.png')}}" style="width:40px;height:40px; " alt="...">
                        </a>
                        </li>
                        <li id="navmessagetwo">
                        <a class="btn btnStyle btn_danger unreadcount" href="{{url('/dmessage')}}" style="border-radius:100%;background-color:tomato;"></a>
                        </li>
                        <li>
                        <a class="btn btnStyle btn_danger" href="{{url('/dcontact')}}">اتصل بنا</a>
                        </li>
                        <li>
                        <a class="btn btnStyle btn_warning" href="{{url('/consultation')}}">الاستشارات</a>
                        </li>
                        <li>
                        <a class="btn btnStyle btn_primary" href="{{url('/logout')}}">تسجيل الخروج</a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </header>
    <!-- headerSection end -->
    
    <section class="topSpace">
    
    <div class="container">
            <span>قريبا سيتم تفعيل رابط تحميل التطبيق</span>
      <div class="appCol">
            <a href="Javascript:void(0)">
                <img src="{{asset('addbyme/images/android.svg')}}" alt="android">
            </a>
            <a href="Javascript:void(0)">
                <img src="{{asset('addbyme/images/ios.svg')}}" alt="ios">
            </a>
        </div>
      </div>
      <div class="spaceContent">
        <div class="container">
          <div class="profileheader">
            <h2>أهلا {{$doctor->fname}} {{$doctor->lname}}</h2>
          </div>
          <div class="profileCol">
            <div class="row no-gutters">
              <div class="col-lg-auto">
                <div class="proSidebar">
                  <div class="profileSec">
                    <div class="profiletitle">
                      <h3>الحساب الخاص بك </h3>
                    </div>
                    <div class="userCol">
                      <span class="userImg"><img src="{{asset('upload/photo/'.$doctor->photo)}}" alt="..." style="border-radius: 100%;height: 100%;border: 2px solid #393939;" id="userimage"></span>
                      <span>{{$doctor->fname}} {{$doctor->lname}} صورة <img src="{{asset('addbyme/images/checkIcon.svg')}}" alt="..."></span>
                      <?php if($status == 'profile'){?>
                      <div class="fileupload btn_gray">
                        <label>تحرير صورة الملف الشخصي</label>
                        <input type="button" id="bt_doctor_image" class="form-control-file ">
                      </div>
                      <?PHP }?>
                      <div style="    margin-top: 20px;">
                      <span style="background: white;   padding: 5px;  border-radius: 10px;">الرصيد {{$doctor->money}}$<span>
                      </div>
                    </div>
                  </div>
                  <div class="tabsSection">
                    <div class="nav flex-column nav-pills">
                      <a class="nav-link <?php if($status == 'profile'){echo 'active';}?>" href="{{url('/profile')}}">تعديل الملف الشخصي</a>
                      <a class="nav-link <?php if($status == 'consultation'){echo 'active';}?>" href="{{url('/consultation')}}">الاستشارات</a>
                      <?php if($doctor->reader == '1'){?>
                      <a class="nav-link <?php if($status == 'manage'){echo 'active';}?>" href="{{url('/manage/')}}">ادارة الاستشارات</a>
                      <?php }?>
                      <a class="nav-link <?php if($status == 'dmessage'){echo 'active';}?>" href="{{url('/dmessage')}}">الاستشارات الحالية</a>
                      <a class="nav-link <?php if($status == 'dendmessage'){echo 'active';}?>" href="{{url('/dendmessage')}}">الاستشارات السابقة</a>
                      <a class="nav-link <?php if($status == 'dcontact'){echo 'active';}?>" href="{{url('/dcontact')}}">اتصل بالإدارة</a>
                      <a class="nav-link <?php if($status == 'bank'){echo 'active';}?>" href="{{url('/bank')}}"><div class="row"><div class="col-md-2 col-2"><img src="{{asset('addbyme/images/bank_black.png')}}" alt="..." ></div><div class="col-md-10  col-10 ">ﺣﺴﺎﺑﻲ ﺍﻟﺒﻨﻜﻲ</div></div ></a>
                    </div>
                  </div>
                </div>
              </div>
               @yield('content')
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FooterSection starts -->
    <section>
        <div class="homeFooter"  style="background-color: white;">
        <div class="container">
            <div class="row">
            <div class="col-md-4">
                <div class="iraqdoc">
                <a href="Javascript:void(0)"><img src="{{asset('addbyme/images/ft-logo.svg')}}" alt="logo"></a>
                </div>
                <div class="footerSocialLinks customSocialLinks">
                <ul>
                    <li>
                    <a href="JavaScript:void(0);"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                    <a href="JavaScript:void(0);"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                    <a href="JavaScript:void(0);"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                </ul>
                </div>
                <div class="signInDiv">
                <a href="{{url('/consultation')}}" class="btn btnStyleBorder createDiv">
                    <img src="{{asset('addbyme/images/user_logo.svg')}}" alt="user_logo"><span class="createbtn">الاستشارات</span>
                </a>
                <a href="{{url('/logout')}}" class="btn btnStyleBorder" >
                    <img src="{{asset('addbyme/images/sign_in_logo.svg')}}" alt="sign"><span class="createbtn">تسجيل الخروج</span>
                </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="appCol">
                <a href="Javascript:void(0)">
                    <img src="{{asset('addbyme/images/android.svg')}}" alt="android">
                </a>
                <a href="Javascript:void(0)">
                    <img src="{{asset('addbyme/images/ios.svg')}}" alt="ios">
                </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footerContact">
                <h3>اتصل بنا</h3>
                <p>العنوان</p>
                <p>123A Chatsworth Road</p>
                <div class="phNumber">
                    <img src="{{asset('addbyme/images/greyheadphone.svg')}}" alt="phone">
                    <div class="contactNum">
                    <p>NW2 4BH</p>
                    <p>07883742745</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="footerInner">
            <div class="footerLogo customLogo">
                <a href="JavaScript:void(0);"><img src="{{asset('addbyme/images/iraqi.svg')}}" alt="..." style="width:100%"></a>
                <span>2019 eHospital.online. All rights reserved</span>
            </div>
            <div class="footerCol customFooterCol">
                <div class="row">
                <div class="col">
                    <div class="footerLinks">
                    <ul>
                        <li>
                        <a href="JavaScript:void(0);"><span><img src="{{asset('addbyme/images/email.svg')}}" alt="..."></span>info@ehospital.online</a>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="paymentLinks">
                    <ul>
                    <li>
                        <a href="javascript:void(0)">
                        <img src="{{asset('addbyme/images/visa.svg')}}" alt="visa">
                    </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                        <img src="{{asset('addbyme/images/mastercard.svg')}}" alt="mastercard">
                    </a>
                    </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- FooterSection end -->
    <!-- Scripts -->
    <script src="{{asset('addbyme/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('addbyme/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('addbyme/js/custom.js')}}"></script>
    @yield('jscontent')
</body>
</html>
