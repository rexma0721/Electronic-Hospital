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
                        <h5 class="content-headline">Bank Table</h5>
                        <p>You can See.</p>
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
                                    <th>Account Number or IBAN </th>
                                    <th>BIC/SWIFT</th>
                                    <th>Doctor Name</th>
                                    <th>Doctor Id</th>
                                    <th>Created Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $bank)
                                        <tr>
                                            <td>{{$bank->number }}</td>
                                            <td>{{$bank->type }}</td>
                                            <td>{{$bank->fname }} {{$bank->lname }}</td>
                                            <td>{{$bank->doctor_id }}</td>
                                            <td>{{Carbon\Carbon::parse($bank->created_at)->format('d-m-Y H:i:s')}}</td>
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
            width: '20%',
            targets: [0]
        }, {
            width: '20%',
            targets: [1]
        }, {
            width: '20%',
            targets: [2]
        }, {
            width: '20%',
            targets: [3]
        }, {
            width: '20%',
            targets: [4]
        }]
    });
</script>
@endsection
