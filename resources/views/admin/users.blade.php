@extends('admin.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if (Session::has('message'))
        <div class="alert alert-success col-md-6" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#addModal">Tambah User</a>
    <a href="#" class="btn btn-outline-success m-3" data-toggle="modal" data-target="#restoreUserModal">Restore User</a>

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
                            <th width=10%>User ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width=10%>User ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Peran</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $p)
                            <tr>
                                <td>{{ $p['user_id'] }}</td>
                                <td>{{ $p['username'] }}</td>
                                <td>{{ $p['name'] }}</td>
                                <td>{{ $p['role_name'] }}</td>
                                <td>
                                    @if ($p['is_actived'] == 1)
                                        Aktif
                                    @else
                                        Nonaktif
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editModal-{{$p['user_id']}}"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$p['user_id']}}"><i class="fas fa-ban"></i></a>
                                </td>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editModal-{{ $p['user_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.update', $p['user_id']) }}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row m-2">
                                                    <label for="username" class="col-sm-3 col-form-label">Username</label>
                                                    <div class="col-sm-7 ml-3">
                                                        <input type="text" class="form-control" name="username" id="username" value="{{ $p['username'] }}">
                                                    </div>
                                                </div>
                                                <div class="row m-2">
                                                    <label for="password" class="col-sm-3 col-form-label">Password</label>
                                                    <div class="col-sm-7 ml-3">
                                                        <input type="password" class="form-control" name="password" id="password">
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

                            <!-- Delete Modal-->
                            <div class="modal fade" id="deleteModal-{{ $p['user_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus User</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.destroy', $p['user_id']) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <div class="modal-body">
                                                Yakin ingin menghapus {{$p['username']}}
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="user" action="{{ route('admin.store') }}" method="post">
                    @csrf
                    <div class="row m-3">
                        <label for="username" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-7 ml-3">
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                    </div>
                    <div class="row m-3">
                        <label for="role" class="col-sm-3 col-form-label">Role</label>
                        <div class="col-sm-7 ml-3">
                            <select class="form-control" name="role" id="role">
                                @foreach ($roles as $r)
                                    <option value="{{ $r['role_id'] }}">{{ $r['role_name'] }}</option>
                                @endforeach
                            </select>
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
    <div class="modal fade" id="restoreUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Restore User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.rusers')}}" method="post">
                        @csrf
                        <div class="row m-2">
                            <label for="id" class="col-sm-3 col-form-label">Pilih User</label>
                            <div class="col-sm-7 ml-3">
                                <select name="id" id="id" class="form-control">
                                    <option value="">--- Pilih User ---</option>
                                    @foreach ($trash as $po)
                                        <option value="{{ $po['user_id'] }}">{{ $po['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


