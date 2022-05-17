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
                            <h5 class="content-headline">Consultant Table</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="datatable-wrapper">
                                <table class="datatable-badges display cell-border" style="text-align:center">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Doctor Name</th>
                                        <th>Type of Service</th>
                                        <th>Service Price</th>
                                        <th>Patient Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($consultants as $consultant)
                                        <tr>
                                            <td>{{Carbon\Carbon::parse($consultant->created_at)->format('d-m-Y')}}</td>
                                            <td>{{Carbon\Carbon::parse($consultant->created_at)->format('H:i:s')}}</td>
                                            <td>{{$consultant->doctorfname.' '.$consultant->doctorlname }}</td>
                                            <td>{{$consultant->type }}</td>
                                            <?php $price = '';
                                                if($consultant->type == 'typing'){
                                                    $price = $consultant->pricechat;
                                                } else if($consultant->type == 'voice') {
                                                    $price = $consultant->pricevoice;
                                                } else {
                                                    $price = $consultant->pricevideo;
                                                }
                                            ?>
                                            <td>{{$price }}</td>
                                            <td>{{$consultant->patientname }}</td>
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
        $('.makemodal2').on('click',function(){
            $('#editid').val($(this).next().val());
            $('#editcategory').val($(this).next().next().val());
        });
        $('.modal').modal();
        $('.datatable-badges').DataTable({
            columnDefs: [{
                width: '15%',
                targets: [0]
            }, {
                width: '15%',
                targets: [1]
            },
                {
                    width: '15%',
                    targets: [2]
                },
                {
                    width: '15%',
                    targets: [3]
                }]
        });
    </script>
@endsection
