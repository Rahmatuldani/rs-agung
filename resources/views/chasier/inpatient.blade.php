@extends('chasier.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pasien Rawat Inap</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Pasien</th>
                            <th>Medrec</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Kamar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Pasien</th>
                            <th>Medrec</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Kamar</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($inpatient as $p)
                            <tr>
                                <td>{{ $p['inpatient_id'] }}</td>
                                <td>{{ $p['medrec_id'] }}</td>
                                <td>{{ $p['patient_name'] }}</td>
                                <td>{{ $p['name'] }}</td>
                                <td>{{ $p['room_name'] }}</td>
                                <td>{{ $p['status'] }}</td>
                                <td>
                                    <a href="{{ route('chas.pinpatient', $p['inpatient_id']) }}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection


