@extends('logistic.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Laporan Logistik</h6>
        </div>
        <div class="card-body">
            <div class="row m-2">
                <label for="fracture" class="col-sm-2 col-form-label">No Fraktur</label>
                <div class="col-sm-3 ml-3">
                    <p id="fracture" class="form-control m-0">{{ $fracture }}</p>
                </div>
            </div>
            <div class="row m-2">
                <label for="name" class="col-sm-2 col-form-label">User</label>
                <div class="col-sm-3 ml-3">
                    <p id="name" class="form-control m-0">{{ $name }}</p>
                </div>
            </div>
            <div class="row m-2">
                <label for="dist" class="col-sm-2 col-form-label">Distributor</label>
                <div class="col-sm-3 ml-3">
                    <p id="dist" class="form-control m-0">{{ $dist }}</p>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mt-4" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Obat</th>
                            <th>Stok Awal</th>
                            <th>Tambah/Kurang</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($log as $m)
                        <tr>
                            <td>{{$m['medicine_name']}}</td>
                            <td>{{ $m['first_stock'] }}</td>
                            <td>{{$m['last_stock']}}</td>
                            <td>{{$m['description']}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <div class="row justify-content-end m-2">
                <a href="{{ route('log.report') }}" class="btn btn-danger justify-content-end">Kembali</a>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection


