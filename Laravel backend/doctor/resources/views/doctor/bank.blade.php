@extends('layouts.appdoctor')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/bank.png')}}" alt="..." style="width:40px;height:40px;">ﺣﺴﺎﺑﻲ ﺍﻟﺒﻨﻜﻲ</h2>
                    </div>
                    <div id="text_bankdetail" class="row" style="padding:10px 30px;">
                        <div class="col-md-10 col-7" style="padding:inherit"> ﻳﺮﺟﻰ ﺍﺩﺧﺎﻝ ﺑﻴﺎﻧﺎﺕ ﺍﻟﺤﺴﺎﺏ ﺍﻟﺒﻨﻜﻲ:</div>
                    </div>
                    <style>
                        .tabDetailCol input {
                            background:#F5F7ED;
                            border-radius:5px; 
                            height:50px;
                            width: 100%;
                            border: 1px solid #C5C5C5;
                            margin-bottom:5px;
                            padding: 5px;
                        }
                        .tabDetailCol button {
                            background:#4124F0;
                            height:50px;
                            border-radius:5px; 
                            width: 100%;
                            margin-bottom:20px;
                            color: white;
                        }
                    </style>
                    <form id="form_bankdetail" class="tabDetailCol" style="padding:10px" action="{{url('addbankaccount')}}"  method="POST">
                        @csrf
                        <?php if($bank == ''){?>
                        <input type="hidden" name="new" value="0">
                        <input type="text" name="number" placeholder="Account Number or IBAN" required>
                        <input type="text" name="type" placeholder="BIC/SWIFT" required>
                        <?php }else{?>
                        <input type="hidden" name="new" value="1">
                        <input type="text" name="number" placeholder="Account Number or IBAN" value="{{$bank->number}}" required>
                        <input type="text" name="type" placeholder="BIC/SWIFT" value="{{$bank->type}}" required>
                        <?php }?>
                        <button id="btn_submit_bankdetail" class="btn">ﺗﺤﺪﻳﺚ</button>
                        <img src="{{asset('addbyme/images/warning.png')}}" width="30px" alt="..." style="margin-left: 10px">ﻣﻼﺣﻈﺔ: ﺍﻟﺒﻴﺎﻧﺎﺕ ﺍﻋﻼﻩ ﻣﻤﻜﻦ ﺍﺳﺘﺤﺼﺎﻟﻬﺎ ﻣﻦ ﺍﻟﺒﻨﻚ ﺍﻟﻤﺼﺪﺭ ﻟﺒﻄﺎﻗﺔ ﺍﻟﻔﻴﺰﺍ ﺍﻭ ﺍﻟﻤﺎﺳﺘﺮ ﻛﺎﺭﺩ
                    </form>
                    <div id="confiremd_div" class="tabDetailCol text-center" style="margin:5rem; display:none;">
                        <div class="row">
                            <div class="col-md-12" style="background: #FBFBFB;border: 1px solid #E9E9E9;box-sizing: border-box; border-radius: 31px; padding:30px;">
                                <img src="{{asset('addbyme/images/confirmed.png')}}" class="img-fluid mb-5">
                                <p>ﺗﻢ ﺗﺤﺪﻳﺚ ﺑﻴﺎﻧﺎﺕ ﺍﻟﺤﺴﺎﺏ ﺍﻟﺒﻨﻜﻲ ﺑﻨﺠﺎﺡ</p>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
@endsection
@section('jscontent')
    <script>
    $('#btn_submit_bankdetail').click(function() {
        $('#text_bankdetail').hide();
        $('#form_bankdetail').hide();
        $('#confiremd_div').show();
        setTimeout(function() {
            $('#form_bankdetail').submit();
        }, 2000);
        return false;
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

