<!DOCTYPE html>
<html lang="en" dir="rtl" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <meta name="generator" content=""/>
    <title>Doctor</title>
  </head>
  <body>
    <div style="float: left; width: 100%; margin: 20px 0;">
      <div style="width: 100%; margin:auto; max-width:630px;">
        <div style="float: left; width:100%; text-align:center">
          <img style="padding-bottom: 10px;" src="{{asset('addbyme/images/doctor.png')}}" alt="doctor" width="80">
        </div>
        <div style="float: left; width: 100%; text-align: center; margin-bottom: 30px;">
          <span style="font-family: Poppins; font-style: normal; font-weight: 600; font-size: 26px; line-height: 22px; text-align: center; color: #253858;">eHospital</span>
        </div>
        <div style="float:left; width: 100%; background: #FFFFFF; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.25); border-radius: 0; border-top:5px solid #595959; padding: 15px;">
          <div style="float:left; width: 100%; display: block;text-align:right;">
            <h2 style="font-family: Tahoma; font-style: normal; font-weight: bold; font-size: 26px; line-height:37px; display:inline-block;  color: #535353;  vertical-align:middle; margin:0;">{{$user->name}}</h2>
            <span style="font-family: IRANSansWeb; font-style: normal; font-weight: bold; font-size: 30px; line-height:  43px; display:inline-block; text-align: right; color: #535353;  vertical-align:middle; padding: 5px 10px;">ﻣﺮﺣﺒﺎ</span>
          </div>
          <div style="float:left; width: 100%; display: block;">
            <h2 style=" vertical-align:middle; text-align: center;font-family: IRANSansWeb; font-style: normal; font-weight: bold; font-size: 30px; line-height: 34px; color: #535353;">ﻳﺮﺟﻰ ﺗﻔﻌﻴﻞ ﺣﺴﺎﺑﻚ</h2>
        </div>
          <div style="float:left; width: 100%; display: block;">
            <h2 style=" vertical-align:middle; text-align: center;font-family: IRANSansWeb; font-style: normal; font-weight: bold; font-size: 24px; line-height: 34px; color: #535353;">ﻟﺘﻔﻌﻴﻞ ﺣﺴﺎﺑﻚ ﻳﺮﺟﻰ ﺍﻟﻀﻐﻂ ﻋﻠﻰ ﺍﻟﺮﺍﺑﻂ ﺍﻟﺘﺎﻟﻲ</h2>
          </div>
          <div style="float: left; width: 100%; display: block; margin-top: 40px; margin-bottom: 40px; direction: rtl;">
            <div style="padding:15px 25px; background: #3B99DA; border-radius: 3px; display: block; margin: auto;  max-width:220px;text-align:center;">
              <a href="{{url('https://ehospital.online/verifyemail/'. $user->api_token)}}" style=" font-family: IRANSansWeb; font-style: normal; font-weight: bold; font-size: 24px; line-height:34px; color: #FFFFFF; display: inline-block; vertical-align: middle;"><img src="{{asset('addbyme/images/arrow.png')}}" alt="arrow" style="display: inline-block; vertical-align: middle;">     ﺗﻔﻌﻴﻞ ﺍﻟﺤﺴﺎﺏ</a>
              </div>
          </div>
          <div style="float: left; width: 100%; display: block;">
            <h2 style="font-family: IRANSansWeb; color:#3B99DA;font-style: normal; font-weight: bold; font-size: 24px; line-height: 43px; text-align:center; margin: 0; padding-bottom: 10px;">ﺷﻜﺮﺍ ﻟﺘﺴﺠﻴﻠﻜﻢ ﻣﻌﻨﺎ</h2>
          </div>
          <div style="float: left; width: 100%; display: block;">
            <h2 style="font-family: IRANSansWeb; font-style: normal; font-weight: bold; font-size: 30px; line-height: 43px; text-align:center; color: #253858; margin: 0; padding-bottom: 10px;">ﺍﻟﻤﺴﺘﺸﻔﻰ ﺍﻻﻟﻜﺘﺮﻭﻧﻲ ﺍﻟﻌﺎﻟﻤﻲ</h2>
          </div>
          <div style="display: block; margin: auto; text-align: center;  float: left; width: 100%;">
            <div style="padding: 0 25px;">
              <h2 style="display: block; border-bottom: 1px solid #253858; padding-bottom: 25px; margin: 0; font-family: IRANSansWeb; font-style: normal; font-weight: normal; font-size: 24px; line-height: 34px; text-align: center; color: #253858; margin-bottom: 25px;">ﺧﺪﻣﺔ ﺍﻻﺳﺘﺸﺎﺭﺍﺕ ﺍﻟﻄﺒﻴﺔ ﺍﻟﻤﻮﺛﻘﺔ</h2>
            </div>
          </div>
          <div style="display: block; margin: auto; text-align: center; padding: 15px 25px;">
            <ul style="display: block; padding-right: 0;">
              <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/instagram.png')}}" width="30" height="" alt="video"></a></li>
              <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/twitter.png')}}" width="30" height="" alt="video"></a></li>
              <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/facebook.png')}}" width="30" height="" alt="audio"></a></li>
              <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/youtube.jpg')}}" width="30" height="" alt="chat"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
