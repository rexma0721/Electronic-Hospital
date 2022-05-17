@extends('layouts.apppatient')

@section('csscontent')
<style>
    .btn_primarySecond {
      border-radius: 5px;
      width: 100%;
      height: 45px;
      background-color: #0057a3;
      font-size: 16px;
      font-weight: 500;
    }
    .selectedbutton.selected
    {
        background-color: rgba(24, 98, 226, 0.82) !important;
        font-family: Montserrat, sans-serif !important;
        color: #fff !important;
    }
    
    .selectedbutton {
      height: 60px !important;
      padding-top: 0px !important;
      padding-bottom: 0px !important;
      border-style: none !important;
      background-color: #fff !important;
      box-shadow: -6px -6px 16px 0 #fff, 6px 6px 16px 0 #d1d9e6 !important;
      -webkit-transition-duration: 200ms, 500ms !important;
      transition-duration: 200ms, 500ms !important;
      color: #171183 !important;
    }

    .selectedbutton:hover {
      background-color: #5100ff !important;
      color: #fff !important;
      font-weight: 700 !important;
    }

    @media(max-width:767px) {
        #cardone
        {
          text-align:center;
        }
        #cardone input
        {
          text-align:center;
        }
    }

</style>
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/advice.png')}}" alt="..." style="width:40px;height:40px;">  ﺍﺿﺎﻓﺔ ﺭﺻﻴﺪ</h2>
                    </div>
                    <?php if($error == ''){?>
                    <form class="tabDetailCol" method="POST" action="{{url('addmoneyaccount')}}"  enctype="multipart/form-data">
                      @csrf
                      <div class="pdCol" style="padding:0px 30px;">
                        <h3 class="tabTitle">الرصيد الحالي : {{$patient->money}}$</h3></br>
                        <h3 class="tabTitle" style="color:red;">{{$error}}</h3>
                        <div class="row rowCol">
                          <div class="col-md-12 heading-4">اضافة الرصيد</div>
                        </div>
                        <div class="row rowCol">
                          <div class="row" style="background-color:#F7F7F7;border-radius: 10px;width: 100%;" id="cardone">  
                            <div class="col-md-12">
                                <style>
                                    .formStyle label {
                                        font-family: IRANSansWeb;
                                        font-style: normal;
                                        font-weight: normal;
                                        font-size: 20px;
                                        line-height: 33px;
                                        display: flex;
                                        align-items: center;
                                        color: #717171;
                                    }
                                </style>
                                <div class="col-md-12 heading-4 _2" style="margin-right: 1rem;margin-top: 2rem;">أختر الرصيد </div>
                                <div class="row" style="padding:1rem;">
                                  <div class="col-md-3">
                                    <div class="form-group formGroup tabInputStyle">
                                      <div class="formStyle">
                                        <input type="button" class="form-control selected selectedbutton"  placeholder="" name="name" value="20" required>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group formGroup tabInputStyle">
                                      <div class="formStyle">
                                        <input type="button" class="form-control selectedbutton"  placeholder="" name="name" value="40" required style="color: #00B468;background: #FFFFFF;border: 2px solid #08917C;border-radius: 12px;">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group formGroup tabInputStyle">
                                      <div class="formStyle">
                                        <input type="button" class="form-control selectedbutton"  placeholder="" name="name" value="50" required style="color: #00B468;background: #FFFFFF;border: 2px solid #08917C;border-radius: 12px;">
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group formGroup tabInputStyle">
                                      <div class="formStyle">
                                        <input type="button" class="form-control selectedbutton"  placeholder="" name="name" value="50" required style="color: #00B468;background: #FFFFFF;border: 2px solid #08917C;border-radius: 12px;">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="div-block-6-copy">
                                  <div class="_1px-div-line"></div>
                                  <h3 class="heading-4 _2 or">أو</h3>
                                  <div class="_1px-div-line"></div>
                                </div>
                                <div class="row" style="padding:1rem;">
                                  <div class="col-md-9 heading-4 _2">أو أكتب الرصيد الذي تود اضافته </div>
                                  <div class="col-md-3">
                                    <div class="form-group formGroup tabInputStyle">
                                      <div class="formStyle">
                                        <input type="number" class="form-control selectedbutton"  value="" min="1" style="color: #00B468;background: #FFFFFF;border: 2px solid #08917C;border-radius: 12px;">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="row" style="padding:1rem;">
                                  <div class="col-md-3 col-6 logo-box big heading-4 _2">طرق الدفع</div>
                                  <div class="col-md-3 col-6 logo-box big white outline"><img src="{{asset('addbyme/images/Mastercard_redyellow.svg')}}" alt="" class="payment-logo medium"></div>
                                  <div class="col-md-3 col-5 logo-box big white outline"><img src="{{asset('addbyme/images/Visa_sm.svg')}}" alt="" class="payment-logo medium"></div>
                                  <div class="col-md-3 col-6 logo-box big white outline"><img src="{{asset('addbyme/images/American-Express.svg')}}" alt="" class="payment-logo medium"></div>
                                </div>
                                <div class="row" style="padding:1rem;">
                                  <input type="text" class="form-control" name="cardname"  value="Visa" required placeholder="Name" hidden>
                                  <input type="text" class="col-md-2 col-12 form-control" name="cvc"  value="" required  placeholder="CCV" style="height: 50px;">
                                  <input type="text" class="col-md-2 col-12 form-control" name="exp_month"  value="" required  placeholder="MM" style="height: 50px;">
                                  <input type="text" class="col-md-2 col-12 form-control" name="exp_year"  value="" required  placeholder="YY" style="height: 50px;">
                                  <input type="text" class="col-md-6 col-12 form-control" name="cardnumber"  value="" required  placeholder="Card Number" style="height: 50px;"> 
                                </div>
                                <div class="row" style="padding:1rem;">
                                  <button class="btn btnStyle btn_primarySecond" style="width: 100%;">ﺗﺄﻛﻴﺪ ﺩﻓﻊ  <span id="pricevalue">10</span>$</button>
                                </div>
                                <div class="col-md-12" style="padding-bottom: 1rem;">
                                    <div class="text-center">
                                        <img src="{{asset('addbyme/images/norton_logo.png')}}" alt="slide_img" style="margin-top: 1rem;">
                                    </div>
                                </div>
                            </div>
                           </div>
                        </div>
                        <input type="hidden" name="amount" id="priceinput" value="10" required>
                    </form>
                    <?php }else if($error == 'no'){?>
                          <div class="tabDetailCol row" style="text-align:center;">
                              <div class="col-md-2">
                              </div>
                              <div class="col-md-8">
                              <div style="padding:30px;background-color:#FDFDFD;border: 1px solid #E9E9E9;box-sizing: border-box;border-radius: 38px;">
                              <img src="{{asset('addbyme/images/afterchangepassword.png')}}"></br></br>
                              ﺗﻢ ﺍﺿﺎﻓﺔ ﺍﻟﺮﺻﻴﺪ ﺑﻨﺠﺎﺡ
                              </div>
                              </div>
                              <div class="col-md-2">
                              </div>
                          </div>
                    <?php } else {?>
                          <div class="tabDetailCol row" style="text-align:center;">
                              <div class="col-md-2">
                              </div>
                              <div class="col-md-8">
                              <div style="padding:30px;background-color:#FDFDFD;border: 1px solid #E9E9E9;box-sizing: border-box;border-radius: 38px;">
                              <img src="{{asset('addbyme/images/warningx.png')}}"></br></br>
                              ﻳﺮﺟﻰ ﺍﻟﺘﺄﻛﺪ ﻣﻦ ﺍﻟﻤﻌﻠﻮﻣﺎﺕ
                              </br><a class="btn btnStyle" href="{{url('/addmoney')}}" style="border-radius: 5px;color:white;background-color:#18A952;padding:12px;">ﺍﻋﺎﺩﺓ ﺍﻟﻤﺤﺎﻭﻟﺔ</a>
                              </div>
                              </div>
                              <div class="col-md-2">
                              </div>
                          </div>
                    <?php }?>
                  </div>
                </div>
                </div>
              </div>
@endsection
@section('jscontent')
    <script>
    $('.selectedbutton').on('click',function(){
        $('.selectedbutton').removeClass('selected');
        $(this).addClass('selected');
        $('#pricevalue').text($(this).val());
        $('#priceinput').val($(this).val());
    });
    $("input.selectedbutton").on('input',function(){
        $('#pricevalue').text($(this).val());
        $('#priceinput').val($(this).val());
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
