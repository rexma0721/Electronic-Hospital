@extends('layouts.appdoctor')

@section('csscontent')
@endsection
@section('content')

               <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane show active">
                    <div class="tabheaderCol">
                      <h2>اتصل بالإدارة</h2>
                    </div>
                    <div class="tabDetailCol" style="padding:5px;">
                      <div class="tableSecTab" style="padding:5px;">
                        <div class="table-responsive">
                            <form method="POST" action="{{url('dcontactus')}}">
                            @csrf
                                <div style="padding:10px 0px;">
                                    <input type="text" name="title" value="doctor" style="width:40%;background-color:#DEDEDE;border-radius: 10px; padding: 5px 30px;" placeholder="الاسم" hidden>
                                </div>
                                <div >
                                    <textarea name="message" style="height: 350px;padding:10px;width:100%;background: #F5F7ED;border: 1px solid #C5C5C5;box-sizing: border-box;border-radius: 8px;" rows="5" placeholder="نص الرسالة"></textarea>
                                </div>
                                <div style="text-align:center;">
                                    <input type="submit" value="ارسال" style="border:none;width:100%;padding: 10px 30px;background: #FFE380;border-radius: 8px;">
                                </div>
                            </form>
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
