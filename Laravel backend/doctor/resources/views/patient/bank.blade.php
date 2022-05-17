@extends('layouts.apppatient')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/bank.png')}}" alt="..." style="width:40px;height:40px;">ﻲﻜﻨﺒﻟﺍ ﻲﺑﺎﺴﺣ</h2>
                    </div>
                    <div class="row" style="padding:10px 30px;">
                        <div class="col-md-10 col-7" style="padding:inherit">:ﻲﻜﻨﺒﻟﺍ ﺏﺎﺴﺤﻟﺍ ﺕﺎﻧﺎﻴﺑ ﻝﺎﺧﺩﺍ ﻰﺟﺮﻳ</div>
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
                    <div class="tabDetailCol" style="padding:10px">
                        <input type="text" placeholder="Account Number or IBAN">
                        <input type="text" placeholder="BIC/SWIFT">
                        <button class="btn">ﺚﻳﺪﺤﺗ</button>
                        <img src="{{asset('addbyme/images/warning.png')}}" width="30px" alt="..." style="margin-left: 10px">ﺩﺭﺎﻛ ﺮﺘﺳﺎﻤﻟﺍ ﻭﺍ ﺍﺰﻴﻔﻟﺍ ﺔﻗﺎﻄﺒﻟ ﺭﺪﺼﻤﻟﺍ ﻚﻨﺒﻟﺍ ﻦﻣ ﺎﻬﻟﺎﺼﺤﺘﺳﺍ ﻦﻜﻤﻣ ﻩﻼﻋﺍ ﺕﺎﻧﺎﻴﺒﻟﺍ :ﺔﻈﺣﻼﻣ
                    </div>
                  </div>
                </div>
                </div>
              </div>
@endsection
@section('jscontent')
    <script>
    $('#addmoneymodal').click();
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

