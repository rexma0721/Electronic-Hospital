<html>
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
        <div style="background: #FFFFFF; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.25); border-radius: 20px;">
          <div style=" background: #6D6BFD; border-radius: 20px 20px 0px 0px; padding:1px 20px;">
            <h2 style="font-family:Tahoma; font-style: normal; font-weight: bold; font-size: 26px; line-height:37px; display: block; align-items: center; color: #FFFFFF; text-align:right">Dr Name <span style="font-family:IRANSansWeb; padding-left:15px; margin:0; color:#fff;">ﺐﻴﺒﻄﻟﺍ</span></h2>
          </div>
          <div>
            <div style="padding:15px 25px; font-family:IRANSansWeb; font-style: normal; font-weight: bold; font-size: 30px; line-height:43px;  display:block; align-items: center; color: #253858; text-align: right;">ﺡﺎﺠﻨﺑ ﻚﺑﺎﺴﺣ ﻞﻴﻌﻔﺗ ﻢﺗ <span ></span></div>
            <div style="padding: 5px 25px; background-color: #1CBA6E;">
              <h2 style="font-family:IRANSansWeb; font-style: normal; font-weight: bold; font-size: 30px; line-height:43px; display:block; align-items: center; text-align: right; color: #FFFFFF; margin:0; text-align: right;">ﻝﻮﺧﺪﻟﺍ ﻞﻴﺻﺎﻔﺗ </h2>
            </div>
            <div style="float: left; width: 100%;">
              <div style="padding: 25px 40px;">
                <form>
                    <div style="display: block; float: left; width: 100%; margin-bottom:20px;">
                      <div style="display: inline-block; float: left; padding-right:15px; width: 80px;">
                        <label for="user" style="float: left; text-align:left;">User Name</label>
                      </div>
                      <div style="display: inline-block; float: left;">
                        <span style="background-color: #1CBA6E; color:#fff; text-align:left; padding:5px 10px; border: 0;">Dr {{$user->fname}} {{$user->lname}}</span>
                      </div>
                    </div>
                    <div style="display: block; float: left; width: 100%; margin-bottom:20px;">
                      <div style="display: inline-block; float: left; padding-right:15px;  width: 80px;">
                        <label for="password">Password</label>
                      </div>
                      <div style="display: inline-block; float: left;">
                        <span style="background-color: #1CBA6E; color:#fff; text-align:left; padding:5px 10px; border: 0;"><?php echo base64_decode($user->password);?></span>
                      </div>
                    </div>
                </form>
              </div>
            </div>
            <div style="background-color:#F3F3F3; float: left; width: 100%;">
              <h2 style="font-family:IRANSansWeb; font-style: normal; font-weight: bold; font-size: 24px; line-height:34px; display:block; align-items: center; text-align: right; padding: 15px; margin:0;"> ﺎﻨﻫ ﻦﻣ ﻝﻮﺧﺪﻟﺍ ﻞﻴﺠﺴﺗ ﻢﻜﻨﻜﻤﻳ ﻞﻴﺻﺎﻔﺘﻟﺍﻭ ﺕﺎﻧﺎﻴﺒﻟﺍ ﻦﻣ ﻱﺍ ﻞﻳﺪﻌﺘﻟ</h2>
            </div>
            <div style="float: left; width: 100%;">
              <h2 style="font-family:IRANSansWeb; font-style: normal; font-weight: bold; font-size: 24px; line-height:34px; text-align:center; color: #EB1C47; margin:0; padding: 20px;">ﺎﻨﻌﻣ ﻢﻜﻠﻴﺠﺴﺘﻟ ﺍﺮﻜﺷ</h2>
            </div>
            <div style="float: left; width: 100%; text-align: center;">
              <img src="{{asset('addbyme/images/doctor.png')}}" alt="doctor" width="80" style="text-align: center; padding: 10px;">
            </div>
            <div style="text-align: center; padding-bottom: 15px; float: left; width: 100%;">
              <h2 style="font-family:IRANSansWeb; font-style: normal; font-weight: bold; font-size: 22px; line-height: 32px; color: #1B1B1B; margin:0;">ﻥﻻﺍ ﻖﻴﺒﻄﺘﻟﺍ ﻞﻤﺣ</h2>
            </div>
            <div style="display: block; margin:auto; text-align: center; padding-bottom:30px; float: left; width: 100%;">
              <div style="display: inline-block; background: #F9F9F9; border: 0.5px solid #B6B6B6; box-sizing: border-box; border-radius: 2px; margin: 0 10px;">
                <div style="display: inline-block; vertical-align:middle; float: left; padding-right:0px;">
                  <img src="{{asset('addbyme/images/android-icon.png')}}" alt="doctor" width="150">
                </div>
              </div>
              <div style="display: inline-block; background: #F9F9F9; border: 0.5px solid #B6B6B6; box-sizing: border-box; border-radius: 2px; margin: 0 10px;">
                <div style="display: inline-block; vertical-align:middle; float: left; padding-right:0px;">
                  <img src="{{asset('addbyme/images/ios-icon.png')}}" alt="doctor" width="150">
                </div>
              </div>
            </div>
            <div style="display: block; padding-bottom: 5px; float: left; width: 100%;">
              <h2 style="font-family:Poppins; font-style: normal; font-weight: 600; font-size: 26px; line-height: 22px; text-align: center; color: #253858; margin:0;">eHospital</h2>
            </div>
            <div style="text-align: center; padding-bottom:10px; float: left; width: 100%;">
              <h2 style="font-family:IRANSansWeb; font-style: normal; font-weight: bold; font-size: 24px; line-height:  34px; display: block; align-items: center; color: #EB1C47; margin:0;">ﻲﻧﻭﺮﺘﻜﻟﻻﺍ ﻰﻔﺸﺘﺴﻤﻟﺍ</h2>
            </div>
            <div style="display: block; margin: auto; text-align: center;  float: left; width: 100%;">
              <div style="padding: 0 25px;">
                <ul style="display: block; border-bottom: 1px solid #253858; padding-bottom: 25px; padding-right: 0;">
                    <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/chat.png')}}" width="30" height="" alt="chat"></a></li>
                    <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/audio.png')}}" width="18" height="" alt="audio"></a></li>
                    <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/video.png')}}" width="30" height="" alt="video"></a></li>
                </ul>
              </div>
            </div>
            <div style="display: block; margin: auto; text-align: center; padding: 15px 25px;">
              <ul style="display: block; padding-right: 0;">
                <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/youtube.jpg')}}" width="30" height="" alt="youtube"></a></li>
                <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/facebook.png')}}" width="30" height="" alt="facebook"></a></li>
                <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/twitter.png')}}" width="30" height="" alt="twitter"></a></li>
                <li style="display: inline-block; padding:0 4px;"><a href="#"><img src="{{asset('addbyme/images/instagram.png')}}" width="30" height="" alt="instagram"></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>