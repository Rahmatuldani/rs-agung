@extends('pharmacy.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar obat di gudang</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Batch ID</th>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Batch ID</th>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($medicine as $p)
                        <tr>
                            <td>{{ $p['batch_id'] }}</td>
                            <td>{{ $p['medicine_name'] }}</td>
                            <td>{{ $p['type_name'] }}</td>
                            <td>{{ $p['medicine_stock'] }}</td>
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


