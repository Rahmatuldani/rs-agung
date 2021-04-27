@extends('admin.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if (Session::has('message'))
        <div class="alert alert-success col-md-6" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#addModal">Tambah Kamar</a>
    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#restoreRoomModal">Restore Kamar</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Kamar</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Kamar</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($room as $p)
                            <tr>
                                <td>{{ $p['room_name'] }}</td>
                                <td>{{ $p['room_class'] }}</td>
                                <td>{{ $p['room_status'] }}</td>
                                <td>{{ $p['room_price'] }}</td>
                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editModal-{{ $p['room_id'] }}"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $p['room_id'] }}"><i class="fas fa-ban"></i></a>
                                </td>
                            </tr>

                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteModal-{{ $p['room_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Kamar</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.delroom', $p['room_id']) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                Yakin ingin menghapus kamar {{$p['room_name']}}
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-danger" type="submit">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editModal-{{ $p['room_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Kamar</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.editroom', $p['room_id']) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row m-3">
                                                    <label for="room_name" class="col-sm-4 col-form-label">Nama Kamar</label>
                                                    <div class="col-sm-7 ml-3">
                                                        <input type="text" class="form-control" id="room_name" name="room_name" value="{{$p['room_name']}}" required>
                                                    </div>
                                                </div>
                                                <div class="row m-3">
                                                    <label for="class" class="col-sm-4 col-form-label">Kelas Kamar</label>
                                                    <div class="col-sm-3 ml-3">
                                                        <input list="roomlist" name="room_class" id="rooms" class="form-control" value="{{$p['room_class']}}" required>
                                                        <datalist id="roomlist">
                                                            <option value="1"></option>
                                                            <option value="2"></option>
                                                            <option value="3"></option>
                                                            <option value="4"></option>
                                                            <option value="5"></option>
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="row m-3">
                                                    <label for="room_price" class="col-sm-4 col-form-label">Harga Kamar</label>
                                                    <div class="col-sm-7 ml-3">
                                                        <input type="text" class="form-control" id="room_price" name="room_price" value="{{$p['room_price']}}" required>
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



        <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kamar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" action="{{ route('admin.addroom') }}" method="post">
                    @csrf
                    <div class="row m-3">
                        <label for="name" class="col-sm-4 col-form-label">Nama Kamar</label>
                        <div class="col-sm-7 ml-3">
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>
                    <div class="row m-3">
                        <label for="class" class="col-sm-4 col-form-label">Kelas Kamar</label>
                        <div class="col-sm-3 ml-3">
                            <select name="class" id="class" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                    <div class="row m-3">
                        <label for="price" class="col-sm-4 col-form-label">Harga Kamar</label>
                        <div class="col-sm-7 ml-3">
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Restore Modal -->
    <div class="modal fade" id="restoreRoomModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restore Kamar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.restroom') }}" method="post">
                        @csrf
                        <div class="row m-2">
                            <label for="id" class="col-sm-3 col-form-label">Pilih Kamar</label>
                            <div class="col-sm-7 ml-3">
                                <select name="id" id="id" class="form-control">
                                    <option value="">--- Pilih Kamar ---</option>
                                    @foreach ($rroom as $po)
                                        <option value="{{ $po['room_id'] }}">{{ $po['room_name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Restore</button>
                        <a href="{{ route('admin.restallroom') }}" class="btn btn-success">Restore All</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


