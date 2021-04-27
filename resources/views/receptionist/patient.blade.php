@extends('receptionist.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    @if (Session::has('message'))
        <div class="alert alert-success col-md-6" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <a href="{{ route('receptionist.create') }}" class="btn btn-outline-success m-3">Tambah Pasien</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=10%>ID Pasien</th>
                            <th>Nama Pasien</th>
                            <th>L/P</th>
                            <th>Umur</th>
                            <th>Tgl Lahir</th>
                            {{-- <th width=10%>Pembayaran</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width=10%>MedRec</th>
                            <th>Nama Pasien</th>
                            <th>L/P</th>
                            <th>Umur</th>
                            <th>Tgl Lahir</th>
                            {{-- <th width=10%>Pembayaran</th> --}}
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($patient as $p)
                            <tr>
                                <td>{{ $p['patient_id'] }}</td>
                                <td>{{ $p['patient_name'] }}</td>
                                <td><?php if ($p['patient_sex'] == 'l') {
                                    echo 'Laki-laki';
                                } else {
                                    echo 'Perempuan';
                                }?></td>
                                <td><?php
                                if ($p['patient_birth'] != null) {
                                    $birth = new DateTime($p['patient_birth']);
                                    $today = new DateTime();
                                    $diff = $today->diff($birth);
                                    echo $diff->y;
                                }?></td>
                                <td><?php
                                    $date = new DateTime($p['patient_birth']);
                                    echo $date->format('d M Y');
                                    ?>
                                </td>
                                {{-- <td>{{ $p['paid_status'] }}</td> --}}
                                <td>
                                    <a href="{{ route('receptionist.show', $p['patient_id']) }}" class="btn btn-primary"><i class="fas fa-user"></i></i></a>
                                    <a href="{{ route('receptionist.edit', $p['patient_id']) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#poliModal-{{ $p['patient_id'] }}" data-id="{{ $p['patient_id'] }}"><i class="fas fa-list-ul"></i></a>
                                </td>
                            </tr>
                            
                            <!-- Logout Modal-->
                            <div class="modal fade" id="poliModal-{{ $p['patient_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Pilih Poli {{ $p['patient_name'] }}</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('receptionist.patientPoli', $p['patient_id']) }}" method="POST">
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
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


