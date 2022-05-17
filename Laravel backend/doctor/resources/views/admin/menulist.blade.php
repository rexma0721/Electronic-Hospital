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
                        <h5 class="content-headline">Menulist Table</h5>
                        <p>You can Create, Edit and Delete.</p>
                    </div>
                    <a class="btn-floating btn-large waves-effect waves-light red goodmodel" href="#modal1" data-target="modal1"><i class="material-icons">add</i></a>
                    <!-- Modal Structure -->
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="datatable-wrapper">
                            <table class="datatable-badges display cell-border" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>Menulist</th>
                                    <th>Price Chat</th>
                                    <th>Price Voice</th>
                                    <th>Price Video</th>
                                    <th>Created Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menulists as $menulist)
                                        <tr>
                                            <td>{{$menulist->text }}</td>
                                            <td>{{$menulist->price_chat }}</td>
                                            <td>{{$menulist->price_voice }}</td>
                                            <td>{{$menulist->price_video }}</td>
                                            <td>{{Carbon\Carbon::parse($menulist->created_at)->format('d-m-Y H:i:s')}}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a class="btn-floating warning-bg makemodal2" href="#modal2" data-target="modal2">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <input type="hidden" value="{{$menulist->id}}">
                                                    <input type="hidden" value="{{$menulist->text}}">
                                                    <input type="hidden" value="{{$menulist->price_chat}}">
                                                    <input type="hidden" value="{{$menulist->price_voice}}">
                                                    <input type="hidden" value="{{$menulist->price_video}}">
                                                    <a class="btn-floating error-bg" onclick="return confirm('Are you sure?')" href="{{ url('/admin/deletemenulist/'.$menulist->id)}}">
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
<div id="modal1" class="modal modal-fixed-footer" style="height: 425px;">
    <form action="{{ url('admin/newmenulist') }}" method="POST">
        <div class="modal-content">
            <h4>Create Menulist</h4>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="text" placeholder="" required>
                <label for="simpletext-input">Menulist</label>
            </div>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="price_chat" placeholder="" required>
                <label for="simpletext-input">Price Chat</label>
            </div>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="price_voice" placeholder="" required>
                <label for="simpletext-input">Price Voice</label>
            </div>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="price_video" placeholder="" required>
                <label for="simpletext-input">Price Video</label>
            </div>
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-action waves-effect waves-green btn-flat ">ADD</button>
        </div>
    </form>
</div>
<div id="modal2" class="modal modal-fixed-footer" style="height: 425px;">
    <form action="{{ url('admin/editmenulist') }}" method="POST">
        <div class="modal-content">
            <h4>Edit Menulist</h4>
            <input type="hidden" id="editid" name="id" placeholder="" required>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" id="editcategory" name="text" placeholder="" required>
                <label for="simpletext-input">Menulist</label>
            </div>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="price_chat" id="editprice_chat" placeholder="" required>
                <label for="simpletext-input">Price Chat</label>
            </div>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="price_voice" id="editprice_voice" placeholder="" required>
                <label for="simpletext-input">Price Voice</label>
            </div>
            <div class="input-field informatic-input col s12">
                <input class="validate" type="text" name="price_video" id="editprice_video" placeholder="" required>
                <label for="simpletext-input">Price Video</label>
            </div>
            <input type="hidden" value="{{ csrf_token() }}" name="_token">
        </div>
        <div class="modal-footer">
            <button type="submit" class="modal-action waves-effect waves-green btn-flat ">UPDATE</button>
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
        $('#editprice_chat').val($(this).next().next().next().val());
        $('#editprice_voice').val($(this).next().next().next().next().val());
        $('#editprice_video').val($(this).next().next().next().next().next().val());
    });
    $('.modal').modal();
    $('.datatable-badges').DataTable({
        columnDefs: [{
            width: '30%',
            targets: [0]
        }, {
            width: '10%',
            targets: [1]
        }, {
            width: '10%',
            targets: [2]
        }, {
            width: '10%',
            targets: [3]
        }, {
            width: '20%',
            targets: [4]
        },{
            width: 'auto',
            targets: [5]
        }]
    });
</script>
@endsection
