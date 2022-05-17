@extends('layouts.appdoctor')

@section('csscontent')
@endsection
@section('content')

               <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane show active">
                    <div class="tabheaderCol">
                      <h2>ادارة الاستشارات</h2>
                    </div>
                    <div class="tabDetailCol">
                      <div class="tableSecTab">
                        <div class="table-responsive">
                          <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">اسم الطبيب</th>
                                  <th scope="col">تاريخ</th>
                                  <th scope="col">نوع الخدمات</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($doctors as $doctorone){?>
                                <tr>
                                  <td>{{$doctorone->fname}} {{$doctorone->lname}}</td>
                                  <td>{{Carbon\Carbon::parse($doctorone->created_at)->format('d/m/Y')}}</td>
                                  <td>
                                    <div class="tblBtns">
                                      <ul>
                                        <li>
                                          <button type="button" name="button" class="btn btnTabl <?php if($doctorone->service_chat == '1'){echo 'btn_secondary';}else{echo 'btn_graysec';}?>"><i class="fa fa-comments-o" aria-hidden="true"></i> Chat</button>
                                        </li>
                                        <li>
                                          <button type="button" name="button" class="btn btnTabl <?php if($doctorone->service_call == '1'){echo 'btn_secondary';}else{echo 'btn_graysec';}?>"><i class="fa fa-phone" aria-hidden="true"></i> Phone</button>
                                        </li>
                                        <li>
                                          <button type="button" name="button" class="btn btnTabl <?php if($doctorone->service_video == '1'){echo 'btn_secondary';}else{echo 'btn_graysec';}?>"><i class="fa fa-video-camera" aria-hidden="true"></i> Video</button>
                                        </li>
                                      </ul>
                                    </div>
                                  </td>
                                </tr>
                                <?php }?>
                              </tbody>
                            </table>
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
