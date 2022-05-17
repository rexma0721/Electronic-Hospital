@extends('layouts.appdoctor')

@section('csscontent')
@endsection
@section('content')

               <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane show active">
                    <div class="tabheaderCol">
                      <h2>الاستشارات</h2>
                    </div>
                    <div class="tabDetailCol">
                      <div class="tableSecTab">
                        <div class="table-responsive">
                          <table class="table">
                              <thead>
                                <tr>
                                  <th scope="col">اسم المريض</th>
                                  <th scope="col">تاريخ</th>
                                  <th scope="col">نوع الخدمات</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($consultants as $consultant){?>
                                <tr>
                                  <td>{{$consultant->name}}</td>
                                  <td>{{Carbon\Carbon::parse($consultant->created_at)->format('d/m/Y')}}</td>
                                  <td>
                                    <div class="tblBtns">
                                      <ul>
                                        <li>
                                          <button type="button" name="button" class="btn btnTabl <?php if($consultant->type == 'typing'){echo 'btn_secondary';}else{echo 'btn_graysec';}?>"><i class="fa fa-comments-o" aria-hidden="true"></i> Chat</button>
                                        </li>
                                        <li>
                                          <button type="button" name="button" class="btn btnTabl <?php if($consultant->type == 'voice'){echo 'btn_secondary';}else{echo 'btn_graysec';}?>"><i class="fa fa-phone" aria-hidden="true"></i> Phone</button>
                                        </li>
                                        <li>
                                          <button type="button" name="button" class="btn btnTabl <?php if($consultant->type == 'video'){echo 'btn_secondary';}else{echo 'btn_graysec';}?>"><i class="fa fa-video-camera" aria-hidden="true"></i> Video</button>
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
