@extends('receptionist.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <a href="{{ route('receptionist.cetak', $p['patient_id']) }}" class="btn btn-outline-warning m-3" target="__blank">Cetak</a>

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pasien {{ $p['patient_name'] }}</h6>
        </div>
        <div class="card-body">
                <div class="row m-2">
                    <label for="patient_name" class="col-sm-2 col-form-label">Nama Lengkap Pasien</label>
                    <div class="col-sm-6 ml-3">
                        <p id="patient_name" class="form-control m-0">{{ $p['patient_name'] }}</p>
                        {{-- <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $p['patient_name'] }}" disabled> --}}
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_sex" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-3 ml-3">
                        <p id="patient_sex" class="form-control m-0">@if ($p['patient_sex'] == 'l')
                            Laki-laki
                        @else
                            Perempuan
                        @endif</p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_birth" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-3 ml-3">
                        <p id="patient_birth" class="form-control m-0">
                            <?php
                                $date = new DateTime($p['patient_birth']);
                                echo $date->format('d F Y');
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="paid_status" class="col-sm-2 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-3 ml-3">
                        <p id="paid_status" class="form-control m-0">@if ($p['paid_status'] == 'tunai')
                            Tunai
                        @else
                            Jaminan
                        @endif</p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_job" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-3 ml-3">
                        <p id="patient_job" class="form-control m-0">{{ $p['patient_job'] }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_partner" class="col-sm-2 col-form-label">Nama Suami/Istri</label>
                    <div class="col-sm-3 ml-3">
                        <p id="paid_status" class="form-control m-0">{{ $p['patient_partner'] }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-6 ml-3">
                        <textarea name="patient_address" id="address" class="form-control" cols="30" rows="3" disabled>{{ $p['patient_address'] }}</textarea>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_phone" class="col-sm-2 col-form-label">Telp. yang bisa dihubungi</label>
                    <div class="col-sm-3 ml-3">
                        <p id="paid_status" class="form-control m-0">{{ $p['patient_phone'] }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="blood_type" class="col-sm-2 col-form-label">Golongan Darah</label>
                    <div class="col-sm-1 ml-3">
                        <p id="paid_status" class="form-control m-0">{{ Str::upper($p['blood_type']) }}</p>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-2 ml-3">
                        <p id="paid_status" class="form-control m-0">{{ $p['religion'] }}</p>
                    </div>
                </div>

                <div class="row justify-content-end m-4">
                    <a href="{{ route('receptionist.patient') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection


