@extends('logistic.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#addType">Tambah Jenis</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Jenis Obat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($type as $m)
                        <tr>
                            <td>{{ $m['type_name'] }}</td>
                            <td>
                                <a class="btn btn-danger" href="{{ route('log.typedelete', $m['type_id']) }}" onclick="event.preventDefault();document.getElementById('type-delete').submit();"><i class="fas fa-trash"></i></a>
                                <form id="type-delete" action="{{ route('log.typedelete', $m['type_id']) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Add Modal -->
<div class="modal fade" id="addType" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Obat</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form class="user" action="{{ route('log.addtype') }}" method="post">
                @csrf
                <div class="row m-3">
                    <label for="name" class="col-sm-3 col-form-label">Nama Jenis Obat</label>
                    <div class="col-sm-7 ml-3">
                        <input type="text" class="form-control" id="name" name="name" required>
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

</div>
<!-- /.container-fluid -->


@endsection


