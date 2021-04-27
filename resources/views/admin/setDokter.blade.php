@extends('admin.layout.app')

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
            <h6 class="m-0 font-weight-bold text-primary">Data Dokter</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nama Dokter</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Dokter</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($doctor as $p)
                            <tr>
                                <td>{{ $p['username'] }}</td>
                                <td>
                                    @if ($p['poli'] != null)
                                        {{ $p['poli_name'] }}
                                    @else
                                        Belum Ada
                                    @endif
                                </td>
                                <td>
                                    @if ($p['is_actived'] == 1)
                                        Aktif
                                    @else
                                        Nonaktif
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#poliModal-{{$p['user_id']}}"><i class="fas fa-edit"></i></a>
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal-{{$p['user_id']}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <!-- Poli Modal-->
                            <div class="modal fade" id="poliModal-{{$p['user_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pilih Poli {{ $p['username'] }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('admin.setdoc', $p['user_id']) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row m-2">
                                                    <label for="patient_name" class="col-sm-2 col-form-label">Poli</label>
                                                    <div class="col-sm-6 ml-3">
                                                        <select name="poli" id="poli" class="form-control">
                                                            @foreach ($poli as $po)
                                                                <option value="{{ $po['poli_id'] }}">{{ $po['poli_name'] }}</option>
                                                            @endforeach
                                                        </select>
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
                            <div class="modal fade" id="hapusModal-{{$p['user_id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Poli {{ $p['username'] }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Yakin ingin menghapus poli untuk dokter {{ $p['username'] }}?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            <a href="{{ route('admin.unsetdoc', $p['user_id']) }}" class="btn btn-primary">Hapus</a>
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

</div>
<!-- /.container-fluid -->

@endsection


