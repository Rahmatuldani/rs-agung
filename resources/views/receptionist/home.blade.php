@extends('receptionist.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if (Session::has('message'))
        <div class="alert alert-success col-md-6" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pasien hari ini</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Pasien</th>
                            <th>Poli</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($patient as $p)
                            <tr>
                                <td>{{ $p['patient_name'] }}</td>
                                <td>{{ $p['poli_name'] }}</td>
                                <td>{{ $p['status'] }}</td>
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


