<!doctype html>
<html dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ csrf_token() }}">
<title>uTravel</title>
<link rel="shortcut icon" sizes="114x114" href="{{{ asset('addbyme/images/logo.jpeg') }}}">
<link rel="stylesheet" href="{{asset('addbyme1/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('addbyme/css/style.css')}}">
<link rel="stylesheet" href="{{asset('addbyme1/css/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('addbyme1/css/slick.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('addbyme1/css/slick-theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('addbyme/css/modalstyle.css')}}">
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

<body style=" font-family: 'IRAQSansWeb_Bold';zoom: 70%; ">
	<section class="upper-part" style="   background-color: #FAFAFA;">
<header class="unique-header">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="logo-box">
					<div class="row m-0 text-right flex-nowrap">
						<div class="col-md-3">
							<img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
						</div>
						<div class="col-md-7">
							<h1>أكبر شركة سياحة<br> وسفر في العراق</h1>
						</div>
						<div class="col-md-3">
							<img src="{{asset('addbyme1/images/new2.png')}}" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="button-box">
					<ul>
                    <li><a href="#" data-toggle="modal" data-target="#myModal3" id="createaccountbutton">انشاء حساب</a></li>
                    <li><a class="bg1" href="#" data-toggle="modal" data-target="#myModal5" id="loginbutton">..تسجيل الدخول</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#myModal8">اتصل بنا</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>
<div class="unique-div">
	<img src="{{asset('addbyme1/images/Capture (2).png')}}" class="capture">
	<div class="container">
		<div class="row">
			<div class="col-md-6">	
			</div>
			<div class="col-md-6">
				<div class="apply-box mr-auto" style="text-align:right">
					<h1>قدم على الفيزا <br>استلمها اونلاين</h1>
					<ul >
						<li><a href="https://turkishvisa.nalsahel.com/">قدّم الان</a>
							<img src="{{asset('addbyme1/images/visa-and-mastercard-logo-26.png')}}" class="img-fluid">
						</li>
						<li><img src="{{asset('addbyme1/images/Rectangle7.png')}}" class="img-fluid" style=" width: 85%;"></li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>
</section>

<section class="down-part">
	<div class="container">
		<div class="row">
			<div class="col-md-6 text-right">
				<ul class="row-content">
					<li><a href="#"  data-toggle="modal" data-target="#myModal3">احجز الان<img src="{{asset('addbyme1/images/Vector (1).png')}}" class="img-fluid mr-2"></a></li>
					<li><h1>عروض الجارتر</h1></li>
				</ul>
			</div>
			<div class="col-md-6 text-left xs-align-right">
				<div class="form-group">
					<label>من</label>
					<select id="flightsel">
						<option value="flight">مدينة</option>
						<?php $f = 0; foreach($offercities as $offercity){
                            if($offercity->flight_id != '' && $f != $offercity->id){$f=$offercity->id;?>
						<option value="flight{{$offercity->id}}">{{$offercity->country_arabic}}/{{$offercity->arabic}}</option>
						<?php }}?>
					</select>
				</div>
			</div>
		</div>
		<div class="unique-slider1 row" style="    margin-top: -25px;">
			<?php foreach($flights as $flight){if($flight->country_id == $flight->flight_country_id){?>
			<div class="flight flight{{$flight->city_id}} col-md-4">
				<div class="slider-box">
					<ul class="only-icons">
						<li class="text-right"><img src="{{asset('addbyme1/images/Vector-1.png')}}" class="img-fluid"></li>
						<li class="text-left"><img src="{{asset('addbyme1/images/Vector2.png')}}" class="img-fluid"></li>
					</ul>
					<div class="inner-content">
						<a href="#">
							<ul>
								<li><h5>{{$flight->o_country}}</h5></li>
								<li><h3>{{$flight->o_airline}}</h3></li>
								<li><h5>{{$flight->o_city}}</h5></li>
							</ul>
							<ul>
								<li><h3>{{$flight->o_departure_time}}</h3></li>
								<li><h6>{{$flight->o_departure}}</h6></li>
								<li><h3>{{$flight->o_arrival_time}}</h3></li>
							</ul>
							<h3 class="price float-right">${{$flight->o_adult}}</h3>
							<div class="clearfix"></div>
						</a>
					</div>
					<?php if($flight->inbound != ''){?>
					<div class="inner-content">
						<a href="#">
							<ul>
								<li><h5>{{$flight->i_country}}</h5></li>
								<li><h3>{{$flight->i_airline}}</h3></li>
								<li><h5>{{$flight->i_city}}</h5></li>
							</ul>
							<ul>
								<li><h3>{{$flight->i_departure_time}}</h3></li>
								<li><h6>{{$flight->i_departure}}</h6></li>
								<li><h3>{{$flight->i_arrival_time}}</h3></li>
							</ul>
							<h3 class="price float-right">${{$flight->o_adult}}</h3>
							<div class="clearfix"></div>
						</a>
					</div>
					<?php }?>
				</div>
			</div>
			<?php } }?>
		</div>
	</div>
</section>
<div class="small-unique">
</div>
<section class="down-part down-part1">
	<div class="container">
		<div class="row">
			<div class="col-md-8 text-right">
				<ul class="row-content">
					<li><a href="#" data-toggle="modal" data-target="#myModal3">احجز الان<img src="{{asset('addbyme1/images/aero.png')}}" class="img-fluid mr-2"></a></li>
					<li><h1>عروض الكروبات</h1></li>
				</ul>
			</div>
			<div class="col-md-4 text-left xs-align-right">
				<div class="form-group">
					<label>الدولة</label>
					<select id="newpackagesel">
						<option value="newpackage">الدولة</option>
						<?php $f = 0;foreach($offercountries as $offercountry){
                            if($offercountry->newpackage_id != '' && $f != $offercountry->id){$f=$offercountry->id;?>
						<option value="newpackage{{$offercountry->id}}">{{$offercountry->arabic}}</option>
						<?php }}?>
					</select>
				</div>
			</div>
		</div>
		<div class="unique-slider"  style="    margin-top: -25px;">
			<?php foreach($newpackages as $newpackage){?>
			<div class="newpackage{{$newpackage->country_id}} newpackage">
				<div class="slider-box">
					
					<div class="inner-content">
						<a href="#">
							<ul>
								<li><h5>{{$newpackage->country}}</h5></li>
								<li><h5>{{$newpackage->city}}</h5></li>
								<li><h5>{{$newpackage->id}}</h5></li>
							</ul>
							<p>{{$newpackage->more_details}}</p>
							<ul>
								<li>
								<h3>الفندق:
								<?php if($newpackage->star >=1){?>
								<img src="{{asset('addbyme1/images/Path.png')}}" class="img-fluid mr-2">
								<?php }if($newpackage->star >=2){?>
								<img src="{{asset('addbyme1/images/Path.png')}}" class="img-fluid mr-2">
								<?php }if($newpackage->star >=3){?>
								<img src="{{asset('addbyme1/images/Path.png')}}" class="img-fluid mr-2">
								<?php }if($newpackage->star >=4){?>
								<img src="{{asset('addbyme1/images/Path.png')}}" class="img-fluid mr-2">
								<?php }if($newpackage->star >=5){?>
								<img src="{{asset('addbyme1/images/path1.png')}}" class="img-fluid mr-2">
								<?php }?>
								</h3>
								<h3>{{$newpackage->hotelname}}</h3></li>
								<li><h3 class="price">8 أيام</h3></li>
							</ul>
							<ul>
								<li><h3>من مطار</h3><h4>{{$newpackage->departure_airport}}</h4></li>
								<li><h3>الى مطار</h3><h4>{{$newpackage->arrival_airport}}</h4></li>
							</ul>
							<ul>
								<li><h3>حفظ برنامج الرحلة</h3></li>
								<li><h5>${{$newpackage->adult}}</h5></li>
							</ul>
							<ul>
								<li><a href="{{asset('upload/doc/'.$newpackage->doc)}}" download><img src="{{asset('addbyme1/images/dowbload.png')}}" class="img-fluid"></a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal3">احجز الان</a></li>
							</ul>
						</a>
					</div>
					
				</div>
			</div>
			<?php }?>
		</div>
	</div>
</section>

<div class="small-unique">
	<div class="container">
		<div class="row text-center">
			<div class="col-md-12">
				<h1> <a href="#" >عروض خاصة؟</a><span style="background-color:white;    padding: 10px;"> إنشأ حساب </span></h1>
			</div>
		</div>
	</div>
</div>
<section class="down-part down-part2">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-right">
				<ul class="row-content">
					<li><img src="{{asset('addbyme1/images/right.png')}}" class="img-fluid mr-2"></li>
					<li><h1>التقديم على فيزا</h1><h2>امكانية متابعة حالة اصدار الفيزا</h2></li>
				</ul>
			</div>
		</div>
		<div class="row box-images text-center">
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/qatar.png')}}" class="img-fluid">
				<p>قطر</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/Rectangle7.png')}}" class="img-fluid">
				<p>تركيا</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/oman.png')}}" class="img-fluid">
				<p>عمان</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/jordan.png')}}" class="img-fluid">
				<p>أردن</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/india.png')}}" class="img-fluid">
				<p>هند</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/uae.png')}}" class="img-fluid">
				<p>الإمارات</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/saudi.png')}}" class="img-fluid">
				<p>السعودية</p>
				</a>
			</div>
		</div>
		<div class="row box-images text-center mt-3">
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/cambodia.png')}}" class="img-fluid">
				<p>كمبوديا</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/azreb.png')}}" class="img-fluid">
				<p>اذربايجان</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/iran.png')}}" class="img-fluid">
				<p>ايران</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/singa.png')}}" class="img-fluid">
				<p>سنغافورة</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/vietnam.png')}}" class="img-fluid">
				<p>فيتنام</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/egypt.png')}}" class="img-fluid">
				<p>مصر</p>
				</a>
			</div>
			<div class="single-image">
				<a href="#">
				<img src="{{asset('addbyme1/images/china.PNG')}}" class="img-fluid">
				<p>الصين</p>
				</a>
			</div>
		</div>
		<div class="row text-center mt-4">
			<div class="col-md-12">
				<a href="#" data-toggle="modal" data-target="#myModal3">قدّم الان</a>
			</div>
		</div>
	</div>
</section>

<footer class="unique-footer">
	<div class="container">
		<div class="row">
			<div class="col-md-5">
				<div class="unique-details" style="text-align:right;">
					<ul class="unique-hrs">
						<li><img src="{{asset('addbyme1/images/open.png')}}" class="img-fluid"></li>
						<li><h5>ساعات الدوام</h5><p>9:00AM - 11:00PM</p></li>
					</ul>
					<div class="two-types d-flex">
						<ul class="unique-hrs w-50">
						<li><img src="{{asset('addbyme1/images/micro.png')}}" class="img-fluid"></li>
						<li><h5>07709999103</h5><p>07804241424</p></li>
					</ul>
					<ul class="unique-hrs w-50">
						<li><img src="{{asset('addbyme1/images/add.png')}}" class="img-fluid"></li>
						<li><h5>العنوان</h5>بغداد - المنصور - شارع مطعم زرزورطنبول</p></li>
					</ul>
					</div>
				</div>
			</div>
			<div class="col-md-2 xs-align-right">
				<img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
			</div>
			<div class="col-md-5 xs-align-right">
				<h1>الطريقة الجديدة والفريدة</h1>
				<h2>لتكتشف العالم</h2>
				<div class="button-box mt-4">
					<ul>
                        <li><a href="#" data-toggle="modal" data-target="#myModal3">انشاء حساب</a></li>
                        <li><a href="#"  data-toggle="modal" data-target="#myModal5">..تسجيل الدخول</a></li>
                        <li><a href="#"  data-toggle="modal" data-target="#myModal8">اتصل بنا</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="row">
				<div class="col-md-4 text-right">
					<p><i class="far fa-envelope ml-2 align-middle"></i>support@najmetalsahel.com</p>
				</div>
				<div class="col-md-4 text-center  xs-align-right">
					<img src="{{asset('addbyme1/images/visa-and-mastercard-logo-26.png')}}" class="img-fluid w-25" style="width: 40%!important;">
					<p>جميع الحقوق محفوظة 2019 ○</p>
				</div>
				<div class="col-md-4">
					<ul class="unique-list list-unstyled p-0 text-center  xs-align-right">
						<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li><a href="#"><i class="fab fa-instagram"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>
  
  
  
  
<?php if(Auth::user() == ''){?>
     <!-- Contact Us Modal -->
    <div class="modal fade" id="myModal8">
        <div class="modal-dialog modal-dialog-centered modal-lg6">
        <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-content"> 
                <div class="modal-header d-block">
                    <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid" style="max-width: 200px;">
                </div>
                <!-- Modal body -->
                <div class="modal-body w-100 text-left">
                    <div class="contact-us2"> 
                        <h3 class="heading-three">اتصل بنا</h3>
                    </div>
                    <form class="contact-us" method="POST" action="{{url('contactus')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control">
                                    <input type="text" name="name" placeholder="الأسم " required>
                                    <i class="fa fa-user e-mail1"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control">
                                    <input type="text" name="phone_number" placeholder="أرقام الموبايلات" required>
                                    <i class="fa fa-phone e-mail1"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-control">
                                    <input type="email" name="email" placeholder="  الإيميل" required>
                                    <i class="fa fa-envelope e-mail1"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-control">
                                    <textarea rows="5" cols="30" placeholder="رسالتك" name="message" required></textarea>
                                </div>
                            </div>
                            <button type="submit" class="ac-link submit">SEND<i class="fa fa-paper-plane"></i></button>
                        </div>
                    </form>	
                </div>     
            </div>
        </div>
    </div>
    <!-- Login Modal -->
    <div class="modal fade" id="myModal5">
        <div class="modal-dialog modal-dialog-centered modal-lg4">
            <div class="modal-content"> 
            <!-- Modal body -->
                <div class="modal-body w-100 text-center"> 
                    <div class="row">
                        <div class="col-md-5 my-auto">
                            <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
                            <p class="verification" style="    font-size: 22px!important;   text-align: center!important">uTravel</p>
                            <a href="#"><p class="small-text">استشكف عندنا افضل العروض</p></a>
                            <a href="#" onclick="createaccountmodal();"class="ac-link">انشاء حساب</a>
                        </div>
                        <div class="col-md-7">
                            <p class="alert text-right" style="display:none">Email or Password was entered in incorrect, please try again</p>
                            <form class="pop-up border-left" method="POST" action="{{url('accountlogin')}}" id="loginform">
                                @csrf
                                <div class="form-control foam">
                                    <label>البريد الألكتروني</label>
                                    <input type="email" name="email" id="loginemail" required>
                                    <i class="fa fa-envelope e-mail"></i>
                                </div>
                                <div class="form-control foam">
                                    <label>الرمز</label>
                                    <input type="password" name="password" id="myInput2" required>
                                    <i class="fa fa-eye password" onclick="myFunction2()"></i>
                                    <i class="fa fa-lock e-mail"></i>
                                </div>
                                <div class="form-control foam d-flex mb-5">
                                    <input type="checkbox" name="remember">
                                    <span class="checkmark"></span>
                                    <label class="ml-3">تذكرني</label>
                                </div>
                                <input type="submit" value="تسجيل الدخول">
                            </form>
                            <input type="hidden" id="loginstatus" value="bad">
                            <a href="#"  onclick="forgotmodal()"><p class="small-text mt-5">هل نسيت كلمة المرور؟</p></a>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <?php if($status == 'reset'){?>
        <a data-toggle="modal" data-target="#myModal14" id="resetmodal" style="display:none;"></a>
        <div class="modal fade" id="myModal14">
            <div class="modal-dialog modal-dialog-centered modal-lg4">
                <div class="modal-content"> 
                <!-- Modal body -->
                    <div class="modal-body w-100 text-center"> 
                        <div class="row">
                            <div class="col-md-5 my-auto">
                                <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
                                <p class="verification" style="    font-size: 22px!important;   text-align: center!important">uTravel</p>
                                <a href="#"><p class="small-text">استشكف عندنا افضل العروض</p></a>
                                <a href="#" onclick="createaccountmodal();"class="ac-link">انشاء حساب</a>
                            </div>
                            <div class="col-md-7">
                                <p class="alert text-right" style="display:none">Email or Password was entered in incorrect, please try again</p>
                                <form class="pop-up border-left" id="resetpasswordform" method="POST" action="{{url('resetnewpassword')}}" >
                                    @csrf
                                    <div class="form-control foam">
                                        <label>كلمة المرور</label>
                                        <input type="password" name="newpasword" id="newpassword" required style="width:100%;    padding-right: 30px;">
                                        <i class="fa fa-eye password" onclick="myFunction3()"></i>
                                        <i class="fa fa-lock e-mail"></i>
                                    </div>
                                    <div class="form-control foam">
                                        <label>اعادة كتابة كلمة المرور</label>
                                        <input type="password" name="retypepassword" id="retypepassword" required style="width:100%;    padding-right: 30px;">
                                        <i class="fa fa-eye password" onclick="myFunction4()"></i>
                                        <i class="fa fa-lock e-mail"></i>
                                    </div>
                                    <input type="hidden" name="token" value="{{$token}}">
                                    <input type="submit" value="Change">
                                </form>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    <?php }?>
    
    <!-- Forgot Modal -->
    <a data-toggle="modal" data-target="#myModal13" id="forgotmodal" style="display:none;"></a>
    <div class="modal fade" id="myModal13">
        <div class="modal-dialog modal-dialog-centered modal-lg4">
            <div class="modal-content"> 
            <!-- Modal body -->
                <div class="modal-body w-100 text-center"> 
                    <div class="row">
                        <div class="col-md-5 my-auto">
                            <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
                            <p class="verification" style="    font-size: 22px!important;   text-align: center!important">uTravel</p>
                            <a href="#"><p class="small-text">استشكف عندنا افضل العروض</p></a>
                            <a href="#" onclick="createaccountmodal1();"class="ac-link">انشاء حساب</a>
                        </div>
                        <div class="col-md-7">
                            <p class="alert text-right" style="color: #253858!important;">الرجاء ادخال البريد الألكتروني</p>
                            <form class="pop-up border-left" id="forgotpasswordform">
                                @csrf
                                <div class="form-control foam">
                                    <label>البريد الألكتروني</label>
                                    <input type="email" name="email" required id="forgotemail"style="width:100%;    padding-right: 30px;">
                                    <i class="fa fa-envelope e-mail"></i>
                                </div>
                                <input type="submit" style="width:225px" value="استعادة كلمة المرور">
                            </form>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
    </div>
    <!-- Create Aaccount Modal -->
    <div class="modal fade" id="myModal3">
        <div class="modal-dialog modal-dialog-centered modal-lg3">
        <!--   <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header d-block">
            
                    <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid" style="max-width: 200px;">
                    <p class="verification booking1">uTravel</p>
                    <a href="#"><p class="small-text">استشكف عندنا افضل العروض</p></a>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                
                    <form class="pop-up text-center"  method="POST" action="{{url('createaccount')}}" id="createaccountform">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control foam">
                                    <label>الأسم</label>
                                    <input type="text" name="first_name" required>
                                </div>
                                <div class="form-control foam">
                                    <label>اللقب</label>
                                    <input type="text" name="last_name" required>
                                </div>
                                <div class="form-control foam">
                                    <label>اسم الشركة </label>
                                    <input type="text" name="travel_agency_name" required>
                                </div>
                                <div class="form-control foam" required>
                                    <label>المدينة</label>
                                    <select name="city" class="visitorcity" required>
                                    <option></option>
                                    <?php foreach($cities as $city){?>
                                        <option value="{{$city->arabic}}">{{$city->arabic}}</option>
                                    <?php }?>
                                    </select>
                                </div>
                                <div class="form-control foam">
                                    <label>المنطقة</label>
                                    <select name="area" class="visitorarea"required>
                                        <option></option>
                                    </select>
                                </div>
                                <div class="form-control foam">
                                    <label>أرقام الموبايلات</label>
                                    <input type="text" name="mobile_number" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control foam">
                                    <label>الإيميل</label>
                                    <input type="email" name="email" required id="companyemail">
                                    <i class="fa fa-envelope e-mail"></i>
                                </div>
                                <div class="form-control foam">
                                    <label>الرمز</label>
                                    <input type="password" name="password" id="myInput" required>
                                    <i class="fa fa-eye password" onclick="myFunction()"></i>
                                    <i class="fa fa-lock e-mail"></i>
                                </div>
                                <p class="text-box" style="text-align:right">يرجى ملاحظة ان هذا القسم خاص فقط بشركات السياحة والسفر </p>
                                <input type="submit" value="التسجيل">
                            </div>
                        </div>
                    </form>
                    <input type="hidden" id="companyemailstatus" value="bad">
                </div>
                
                <!-- Modal footer -->
                <div class="modal-footer">
                    <p class="verification booking1"><a href="#" onclick="loginmodal()">مسجّل عدنه من قبل؟ قم بتسجيل الدخول</a></p>
                </div>
                
            </div>
        </div>
    </div>
    <!-- Create Follow Modal -->
    <a data-toggle="modal" data-target="#myModal9" id="followmodal" style="display:none;"></a>
    <div class="modal fade" id="myModal9">
        <div class="modal-dialog modal-dialog-centered">
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-content borderradius"> 
                <div class="modal-header d-block"  style="text-align:center!important;">
                    <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
                </div>
                <!-- Modal body -->
                <div class="modal-body w-100 text-center">
                    <div class="comany-image">
                        <h3 class="heading-four d-inline-block" id="followcompanyname">Company Name</h3><img src="{{asset('addbyme/images/Capture.png')}}" class="img-fluid d-inline-block">
                    </div>
                    <form class="contact-us" method="POST" action="{{url('followcompany')}}"  >
                        @csrf
                        <input type="hidden" name="company_id" id="followcompanyid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-control">
                                <input type="text" name="fname" placeholder="الأسم ">
                                <i class="fa fa-user e-mail1"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-control">
                                <input type="text" name="lname" placeholder="اللقب">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-control">
                                    <input type="email" name="email" placeholder="الأيميل">
                                    <i class="fa fa-envelope e-mail1"></i>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="verification text-left booking2" style="text-align:right!important;    line-height: 35px;">ستقوم باستلام اي عروض جديدة من قبل <span id="followcompanyname1">Company Name</span></p>
                            </div>
                            <button type="submit" class="ac-link submit">متابعة عروض الشركة</button>
                        </div>
                    </form> 
                </div>    
            </div>
        </div>
    </div>
    <!-- After Create Modal -->
    <a data-toggle="modal" data-target="#myModal7" id="aftercreateaccount" style="display:none;"></a>
    <div class="modal fade" id="myModal7">
        <div class="modal-dialog modal-dialog-centered modal-lg5">
            <!--   <button type="button" class="close" data-dismiss="modal">&times;</button> -->
            <div class="modal-content"> 
                <div class="modal-header d-block">
                    <img src="{{asset('addbyme/images/logo.jpeg')}}" class="img-fluid">
                    <p class="verification verification1">uTravel</p>
                    <a href="#"><p class="small-text">استشكف عندنا افضل العروض</p></a>
                </div>
                <!-- Modal body -->
                <div class="modal-body w-100 text-center"> 
                    <div class="row">
                        <div class="col-md-12">
                            <img src="{{asset('addbyme/images/confirmed.png')}}" class="img-fluid mb-5">
                            <p class="verification">شكرا لتسجيكم n </p>
                            <p class="verification">سنقوم بالاتصال بكم خلال 24 ساعة</p>
                        </div>
                    </div>
                </div>  
                <!-- Modal footer -->
                <div class="modal-footer conts">
                    <p class="verification"><?php echo '<span>'.$after_company_signup->content.'</span>';?></p>
                </div> 
            </div>
        </div>
    </div>

    
    <?php }?>




<script src="{{asset('addbyme1/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('addbyme1/js/bootstrap.min.js')}}"></script>	
<script src="{{asset('addbyme1/js/slick.js')}}"></script>
    <script type="text/javascript" src="{{asset('addbyme/js/bootstrap-datepicker.js')}}"></script>
<script type="text/javascript" src="{{asset('addbyme/js/my.js')}}"></script>

<script>
        $('.unique-slider').slick({
  dots: false,
  infinite: true,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows:true,
  rtl:true,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1,
        infinite: true,
        dots: false,
        arrows:true,
        rtl:true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false,
        rtl:true
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows:false,
        rtl:true
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});    
$('#newpackagesel').on('change',function(){
	$('.newpackage').hide();
	$('.'+$('#newpackagesel').val()).show();
})

$('#flightsel').on('change',function(){
	$('.flight').hide();
	$('.'+$('#flightsel').val()).show();
})
</script>
   
	
</body>
</html>