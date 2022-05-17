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
                        <h5 class="content-headline">Contact Us Table</h5>
                        <p>You can Delete.</p>
                    </div>
                    <!-- Modal Structure -->
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="datatable-wrapper">
                            <table class="datatable-badges display cell-border" style="text-align:center">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Text</th>
                                    <th>Created Time</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td>{{$contact->name }}</td>
                                            <td>{{$contact->phone }}</td>
                                            <td>{{$contact->email }}</td>
                                            <td>{{$contact->text }}</td>
                                            <td>{{Carbon\Carbon::parse($contact->created_at)->format('d-m-Y H:i:s')}}</td>
                                            <td>
                                                <div class="action-btns">
                                                    <a class="btn-floating error-bg" onclick="return confirm('Are you sure?')" href="{{ url('/admin/deletecontact/'.$contact->id)}}">
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

@endsection

@section('js')        

<script>
    $(document).ready(function() {
		$('select[name=DataTables_Table_0_length]').show();
	});
    $('.datatable-badges').DataTable({
        columnDefs: [{
            width: '10%',
            targets: [0]
        }, {
            width: '10%',
            targets: [1]
        }, {
            width: '10%',
            targets: [2]
        }, {
            width: '50%',
            targets: [3]
        }, {
            width: '10%',
            targets: [4]
        },{
            width: 'auto',
            targets: [5]
        }]
    });
</script>
@endsection
