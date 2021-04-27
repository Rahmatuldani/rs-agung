@extends('logistic.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <a href="{{ route('log.distributor') }}" class="btn btn-outline-success m-3">Tambah Distributor</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Distributor</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No NPWP</th>
                            <th>Nama Distributor</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No NPWP</th>
                            <th>Nama Distributor</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dist as $m)
                        <tr>
                            <td>{{$m['npwp']}}</td>
                            <td>{{ $m['distributor_name'] }}</td>
                            <td>{{$m['distributor_address']}}</td>
                            <td>{{$m['distributor_phone']}}</td>
                            <td>
                                <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#distModal-{{$m['distributor_id']}}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-danger" href="{{ route('log.destroydist', $m['distributor_id']) }}" onclick="event.preventDefault();document.getElementById('dist-destroy').submit();"><i class="fas fa-trash"></i></a>
                                <form id="dist-destroy" action="{{ route('log.destroydist', $m['distributor_id']) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal-->
                        <div class="modal fade" id="distModal-{{ $m['distributor_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit {{$m['distributor_name']}}</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('logistic.update', $m['distributor_id']) }}" method="POST">
                                        @method('PUT')
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row m-2">
                                                <label for="npwp" class="col-sm-3 col-form-label">NPWP</label>
                                                <div class="col-sm-7 ml-3">
                                                    <input type="text" name="npwp" id="npwp" class="form-control" value="{{$m['npwp']}}">
                                                </div>
                                            </div>
                                            <div class="row m-2">
                                                <label for="name" class="col-sm-3 col-form-label">Nama Distributor</label>
                                                <div class="col-sm-7 ml-3">
                                                    <input type="text" name="name" id="name" class="form-control" value="{{$m['distributor_name']}}">
                                                </div>
                                            </div>
                                            <div class="row m-2">
                                                <label for="address" class="col-sm-3 col-form-label">Alamat</label>
                                                <div class="col-sm-7 ml-3">
                                                    <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{$m['distributor_address']}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row m-2">
                                                <label for="phone" class="col-sm-3 col-form-label">No Telp</label>
                                                <div class="col-sm-7 ml-3">
                                                    <input type="text" name="phone" id="phone" class="form-control" value="{{$m['distributor_phone']}}">
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


