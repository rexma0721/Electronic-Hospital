@extends('layouts.apppatient')

@section('csscontent')
@endsection
@section('content')

              <div class="col-lg">
                <div class="tabContentCol">
                  <div class="tab-content">
                  <div class="tab-pane fade show active">
                    <div class="tabheaderCol">
                      <h2><img src="{{asset('addbyme/images/message_white.png')}}" alt="..." style="width:40px;height:40px;">   ﺍﺳﺘﺸﺎﺭﺓ ﻛﺘﺎﺑﻴﺔ</h2>
                    </div>
                    <?php if($statusone == 'bad'){?>
                    <div class="tabDetailCol" style="padding: 20px;">
                        <h3 class="tabTitle" style="color:red;">Already created Consultant with this doctor.</h3>
                    </div>
                    <?php }?>
                    <?php foreach($consultants as $consultant){?>
                    <?php $i = 0;foreach($unreadchats as $unreadchat){if($unreadchat->id == $consultant->id){ $i++;}} if($i !=0){?>
                    <div class="tabDetailCol row" style="border-bottom: black;padding: 20px;   border-style: inset;">
                        <div class="col-md-2" style="padding: inherit;">  
                            <span>{{$consultant->fname}} {{$consultant->lname}}</span>  
                        </div> 
                        <div class="col-md-2" style="padding: inherit;">
                            <span>{{$i}}</span>
                        </div>   
                        <div class="col-md-4" style="padding: inherit;">
                            <span>{{$consultant->created_at}}</span>  
                        </div>  
                        <div class="col-md-4"> 
                            <?php if($consultant->type == 'typing' && $consultant->status=="now") {?>
                                <a href="{{ url('/onemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/email.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'typing' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dmail.png')}}" alt="...">
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="now") {?>
                                <a href="{{ url('/onemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/ecall.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dcall.png')}}" alt="...">
                            <?php } else if($consultant->type == 'video' && $consultant->status=="now") {?>
                                <a href="{{ url('/onemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/evideo.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'video' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dvideo.png')}}" alt="...">
                            <?php }?>  
                        </div>  
                    </div> 
                    <?php } }?>
                    <?php foreach($consultants as $consultant){?>
                    <?php $i = 0;foreach($unreadchats as $unreadchat){if($unreadchat->id == $consultant->id){ $i++;}} if($i ==0){?>
                    <div class="tabDetailCol row" style="border-bottom: black;padding: 20px;   border-style: inset;">
                        <div class="col-md-2" style="padding: inherit;">  
                            <span>{{$consultant->fname}} {{$consultant->lname}}</span>  
                        </div> 
                        <div class="col-md-2" style="padding: inherit;">
                            <span>{{$i}}</span>
                        </div>   
                        <div class="col-md-4" style="padding: inherit;">
                            <span>{{$consultant->created_at}}</span>  
                        </div>  
                        <div class="col-md-4"> 
                            <?php if($consultant->type == 'typing' && $consultant->status=="now") {?>
                                <a href="{{ url('/onemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/email.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'typing' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dmail.png')}}" alt="...">
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="now") {?>
                                <a href="{{ url('/onemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/ecall.png')}}" alt="..."></a>
                            <?php } else if($consultant->type == 'voice' && $consultant->status=="old") {?>
                                <img src="{{asset('addbyme/images/dcall.png')}}" alt="...">
                            <?php } else if($consultant->type == 'video' && $consultant->status=="now") {?>
                                <a href="{{ url('/onemessage/'.$consultant->id)}}"><img src="{{asset('addbyme/images/evideo.png')}}" alt="..."></a>
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
    $('#bt_patient_image').on('click',function(){
        $('input[name="photo"]').click();
    });
    $('input[name="photo"]').on('change',function(e){
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onloadend =function(){
            $('#userimage').attr('src', reader.result);
        }
        reader.readAsDataURL(file);    
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

