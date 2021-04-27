@extends('admin.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if (Session::has('message'))
        <div class="alert alert-success col-md-6" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#addModal">Tambah Poli</a>
    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#restoreModal">Restore Poli</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=10%>Poli ID</th>
                            <th>Nama Poli</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width=10%>Poli ID</th>
                            <th>Nama Poli</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($poli as $p)
                            <tr>
                                <td>{{ $p['poli_id'] }}</td>
                                <td>{{ $p['poli_name'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$p['poli_id']}}"><i class="fas fa-ban"></i></a>
                                </td>
                            </tr>
                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteModal-{{ $p['poli_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Poli {{ $p['poli_name'] }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menghapus poli {{$p['poli_name']}}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form id="del-form" action="{{ route('admin.delpoli', $p['poli_id']) }}" method="POST" class="d-none">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-danger" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Poli</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" action="{{ route('admin.addpoli') }}" method="post">
                    @csrf
                    <div class="row m-3">
                        <label for="poli_name" class="col-sm-3 col-form-label">Nama Poli</label>
                        <div class="col-sm-7 ml-3">
                            <input type="text" class="form-control" id="poli_name" name="poli_name" required>
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

    <!-- Restore Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restore Poli</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.restpoli') }}" method="post">
                        @csrf
                        <div class="row m-2">
                            <label for="id" class="col-sm-3 col-form-label">Pilih Poli</label>
                            <div class="col-sm-7 ml-3">
                                <select name="id" id="id" class="form-control">
                                    <option value="">--- Pilih Poli ---</option>
                                    @foreach ($rpoli as $po)
                                        <option value="{{ $po['poli_id'] }}">{{ $po['poli_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Restore</button>
                        <a href="{{ route('admin.restallpoli') }}" class="btn btn-success">Restore All</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


