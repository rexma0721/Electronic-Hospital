@extends('admin.layout.default')


@section('content')
<div class="main-container">
    {{-- Tables --}}
    <div class="row">
        <!-- With Action-->
        <div class="col s12">
            <div class="card-panel">
                <div class="row box-title">
                    <div class="col s12">
                        <h5 class="content-headline">City Table</h5>
                        <p>You can Create, Edit and Delete.</p>
                    </div>
                    <a class="btn-floating btn-large waves-effect waves-light red goodmodel" id="makemodal" href="#modal1" data-target="modal1"><i class="material-icons">add</i></a>
                    <!-- Modal Structure -->
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="datatable-wrapper">
                            <table class="datatable-badges display cell-border" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Created Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cities as $city)
                                        <tr>
                                            <td>{{$city->text }}</td>
                                            <td>{{$city->country }}</td>
                                            <td>{{Carbon\Carbon::parse($city->created_at)->format('d-m-Y H:i:s')}}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a class="btn-floating warning-bg makemodal2" href="#modal2" data-target="modal2">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <input type="hidden" value="{{$city->id}}">
                                                    <input type="hidden" value="{{$city->text}}">
                                                    <input type="hidden" value="{{$city->country_id}}">
                                                    <input type="hidden" value="{{$city->country}}">
                                                    <a class="btn-floating error-bg" onclick="return confirm('Are you sure?')" href="{{ url('/admin/deletecity/'.$city->id)}}">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal1" class="modal modal-fixed-footer" style="height: 315px;">
    <form action="{{ url('admin/newcity') }}" method="POST">
        <div class="modal-content">
            <h4>Create City</h4>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="text" placeholder="" required>
                <label for="simpletext-input">City</label>
            </div>
            <select class="select2_select" name="country_id" style="display: block; margin-top: 30px;" required>
            <?php foreach($countries as $country){?>
                <option value="{{$country->id}}">{{$country->text}}</option>
            <?php }?>
            </select>
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">ADD</button>
        </div>
    </form>
</div>
<div id="modal2" class="modal modal-fixed-footer" style="height: 315px;">
    <form action="{{ url('admin/editcity') }}" method="POST">
        <div class="modal-content">
            <h4>Edit City</h4>
            <input type="hidden" id="editid" name="id" placeholder="" required>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" id="editcategory" name="text" placeholder="" required>
                <label for="simpletext-input">City</label>
            </div>
            <select class="select2_select" name="country_id" style="display: block; margin-top: 30px;" required>
            <option value='' id="selmenulist"></option>
            <?php foreach($countries as $country){?>
                <option value="{{$country->id}}">{{$country->text}}</option>
            <?php }?>
            </select>
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">UPDATE</button>
        </div>
    </form>
</div>
@endsection

@section('js')        

<script>
    $(document).ready(function() {
		$('select[name=DataTables_Table_0_length]').show();
	});
    $('.makemodal2').on('click',function(){
        $('#editid').val($(this).next().val());
        $('#editcategory').val($(this).next().next().val());
        $city = $(this).next().next().next().val();
        $("#selmenulist").val($city);
        $city = $(this).next().next().next().next().val();
        $("#selmenulist").text($city);
    });
    $('.modal').modal();
    $('.datatable-badges').DataTable({
        columnDefs: [{
            width: '25%',
            targets: [0]
        }, {
            width: '25%',
            targets: [1]
        },{
            width: '25%',
            targets: [2]
        },{
            width: 'auto',
            targets: [3]
        }]
    });
</script>
@endsection
