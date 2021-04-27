@extends('logistic.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <a href="{{ route('logistic.create') }}" class="btn btn-outline-success m-3">Tambah Obat</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar obat</h6>
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
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Batch ID</th>
                            <th>Nama Obat</th>
                            <th>Jenis</th>
                            <th>Stok</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($medicine as $m)
                        <tr>
                            <td>{{ $m['batch_id'] }}</td>
                            <td>{{ $m['medicine_name'] }}</td>
                            <td>{{ $m['type_name'] }}</td>
                            <td>{{ $m['medicine_stock'] }}</td>
                            <td>{{ $m['medicine_price'] }}</td>
                            <td>
                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editMedModal-{{ $m['batch_id'] }}"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteMedModal-{{ $m['batch_id'] }}" ><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>

                        <!-- Delete Modal-->
                        <div class="modal fade" id="deleteMedModal-{{$m['batch_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Obat {{$m['medicine_name']}}</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Yakin ingin menghapus obat {{$m['medicine_name']}} dari gudang?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-primary" href="{{ route('logistic.destroy', $m['batch_id']) }}" onclick="event.preventDefault();document.getElementById('delete-form').submit();">Hapus</a>
                                        <form id="delete-form" action="{{ route('logistic.destroy', $m['batch_id']) }}" method="POST" class="d-none">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal-->
                        <div class="modal fade" id="editMedModal-{{$m['batch_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit Obat {{$m['medicine_name']}}</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="#" method="POST">
                                        @method('PUT')
                                        @csrf
                                    <div class="modal-body">
                                        <div class="row m-3">
                                            <label for="name" class="col-sm-4 col-form-label">Nama</label>
                                            <div class="col-sm-7 ml-3">
                                                <input type="text" class="form-control" id="name" name="name" value="{{$m['medicine_name']}}" required>
                                            </div>
                                        </div>
                                        <div class="row m-3">
                                            <label for="type" class="col-sm-4 col-form-label">Jenis</label>
                                            <div class="col-sm-7 ml-3">
                                                <input list="typeList" name="type" class="form-control" value="{{$m['type_name']}}" required>
                                                    <datalist id="typeList">
                                                        @foreach ($type as $t)
                                                            <option value="{{ $t['type_name'] }}"></option>
                                                        @endforeach
                                                    </datalist>
                                            </div>
                                        </div>
                                        <div class="row m-3">
                                            <label for="price" class="col-sm-4 col-form-label">Harga</label>
                                            <div class="col-sm-7 ml-3">
                                                <input type="number" class="form-control" id="price" name="price" value="{{$m['medicine_price']}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection


