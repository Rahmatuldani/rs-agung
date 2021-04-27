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
                                <td>{{ $p['room_status'] }} ({{$p['room_capacity'].'/'.$p['room_class']+1}})</td>
                                <td>{{ $p['room_price'] }}</td>
                                <td>
                                    @if ($p['room_capacity'] != 0)
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#editModal-{{ $p['room_id'] }}"><i class="fas fa-edit"></i></a>
                                    @endif
                                </td>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editModal-{{ $p['room_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Daftar Kamar</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('receptionist.droom', $p['room_id']) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row m-3">
                                                    <label for="patient_id" class="col-sm-4 col-form-label">Nama Pasien</label>
                                                    <div class="col-sm-7 ml-3">
                                                        <select name="patient_id" id="patient_id" class="form-control" required>
                                                            <option value="" selected disabled>-- Pilih Pasien --</option>
                                                            @foreach ($inpatient as $p)
                                                                <option value="{{$p['inpatient_id']}}">{{$p['patient_name']}}</option>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
<!-- /.container-fluid -->

@endsection


