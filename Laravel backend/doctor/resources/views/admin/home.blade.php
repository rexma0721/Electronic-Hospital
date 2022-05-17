@extends('admin.layout.default')
@section('css')

@endsection

@section('jsPostApp')
@endsection

@section('content')
<div class="main-container">
<div class="card small" style="padding:30px;">
    <form class="row" style="padding:100px;" action="{{url('admin/changefee')}}" method="POST">
        @csrf
        <div class="col-md-2 col m2" style="text-align:right;">
            Fee Price : 
        </div>
        <div class="col-md-2 col m2">
            <input name="price" type="number" placeholder="PRICE OF FEE" value="{{$fee->price}}">
        </div>
        <div class="col-md-2 col m2" style="text-align:right;">
            Fee Status : 
        </div>
        <div class="col-md-2 col m2">
            <div class="switch">
                <label>
                    Off
                    <input type="checkbox" name="status" <?php if($fee->status == 1){echo 'checked';}?> value="1">
                    <span class="lever"></span>
                    On
                </label>
            </div>
        </div>
        <div class="col-md-2 col m2">
            <button class="waves-effect waves-light btn-large black">Set</button> 
        </div>
        <div class="col-md-2 col m2">
        </div>
    </form>
</div>
</div>
@endsection
