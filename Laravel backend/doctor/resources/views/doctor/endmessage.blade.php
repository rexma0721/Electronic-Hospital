@extends('layouts.appdoctor')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/message_white.png')}}" alt="..." style="width:40px;height:40px;">   تعديل الملف الشخصي</h2>
                    </div>
                    <?php foreach($consultants as $consultant){?>
                    <?php $i = 0;foreach($unreadchats as $unreadchat){if($unreadchat->id == $consultant->id){ $i++;}} if($i != 0){?>
                    <div class="tabDetailCol row" style="border-bottom: black;padding: 20px;   border-style: inset;">
                        <div class="col-md-2" style="padding: inherit;">  
                            <span>{{$consultant->name}}</span>  
                        </div> 
                        <div class="col-md-2" style="padding: inherit;">
                            <span>{{$i}}</span>
                        </div>    
                        <div class="col-md-4" style="padding: inherit;">
                            <span>{{$consultant->created_at}}</span>  
                        </div>  
                        <div class="col-md-4"> 
                            <?php if($consultant->type == 'typing' && $consultant->status=="now") {?>
                                <a href="{{ url('/donemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/email.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'typing' && $consultant->status="old") {?>
                                <img src="{{asset('addbyme/images/dmail.png')}}" alt="...">
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="now") {?>
                                <a href="{{ url('/donemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/ecall.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dcall.png')}}" alt="...">
                            <?php } else if($consultant->type == 'video' && $consultant->status=="now") {?>
                                <a href="{{ url('/donemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/evideo.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'video' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dvideo.png')}}" alt="...">
                            <?php }?>  
                        </div>  
                    </div> 
                    <?php } }?>
                    <?php foreach($consultants as $consultant){?>
                    <?php $i = 0;foreach($unreadchats as $unreadchat){if($unreadchat->id == $consultant->id){ $i++;}} if($i == 0){?>
                    <div class="tabDetailCol row" style="border-bottom: black;padding: 20px;   border-style: inset;">
                        <div class="col-md-2" style="padding: inherit;">  
                            <span>{{$consultant->name}}</span>  
                        </div> 
                        <div class="col-md-2" style="padding: inherit;">
                            <span>{{$i}}</span>
                        </div>    
                        <div class="col-md-4" style="padding: inherit;">
                            <span>{{$consultant->created_at}}</span>  
                        </div>  
                        <div class="col-md-4"> 
                            <?php if($consultant->type == 'typing' && $consultant->status=="now") {?>
                                <a href="{{ url('/donemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/email.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'typing' && $consultant->status="old") {?>
                                <img src="{{asset('addbyme/images/dmail.png')}}" alt="...">
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="now") {?>
                                <a href="{{ url('/donemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/ecall.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dcall.png')}}" alt="...">
                            <?php } else if($consultant->type == 'video' && $consultant->status=="now") {?>
                                <a href="{{ url('/donemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/evideo.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'video' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dvideo.png')}}" alt="...">
                            <?php }?>  
                        </div>  
                    </div> 
                    <?php } }?>
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

