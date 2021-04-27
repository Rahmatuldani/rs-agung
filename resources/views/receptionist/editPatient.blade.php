@extends('receptionist.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Edit Pasien</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger col-sm-5">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('receptionist.update', $p['patient_id']) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row m-2">
                    <label for="patient_name" class="col-sm-2 col-form-label">Nama Lengkap Pasien</label>
                    <div class="col-sm-6 ml-3">
                        <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $p['patient_name'] }}">
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_sex" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-6 ml-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patient_sex" id="patient_sex" value="l"
                            @if ($p['patient_sex'] == 'l')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="patient_sex">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="patient_sex" id="p" value="p"
                            @if ($p['patient_sex'] == 'p')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="patient_sex">
                                Perempuan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_birth" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-3 ml-3">
                        <input type="date" class="form-control" name="patient_birth" id="patient_birth" value="{{ $p['patient_birth'] }}">
                    </div>
                </div>
                <div class="row m-2">
                    <label for="paid_status" class="col-sm-2 col-form-label">Status Pembayaran</label>
                    <div class="col-sm-6 ml-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paid_status" id="paid_status" value="tunai"
                            @if ($p['paid_status'] == 'tunai')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="paid_status">
                                Tunai
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="paid_status" id="jaminan" value="jaminan"
                            @if ($p['paid_status'] == 'jaminan')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="paid_status">
                                Jaminan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_job" class="col-sm-2 col-form-label">Pekerjaan</label>
                    <div class="col-sm-6 ml-3">
                        <input type="text" name="patient_job" class="form-control" id="patient_job" value="{{ $p['patient_job'] }}">
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_partner" class="col-sm-2 col-form-label">Nama Suami/Istri</label>
                    <div class="col-sm-6 ml-3">
                        <input type="text" class="form-control" id="patient_partner" name="patient_partner" value="{{ $p['patient_partner'] }}">
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_address" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-6 ml-3">
                        <textarea name="patient_address" id="address" class="form-control" cols="30" rows="5">{{ $p['patient_address'] }}</textarea>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="patient_phone" class="col-sm-2 col-form-label">Telp. yang bisa dihubungi</label>
                    <div class="col-sm-6 ml-3">
                        <input type="text" class="form-control" id="patient_phone" name="patient_phone" value="{{ $p['patient_phone'] }}">
                    </div>
                </div>
                <div class="row m-2">
                    <label for="blood_type" class="col-sm-2 col-form-label">Golongan Darah</label>
                    <div class="col-sm-6 ml-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blood_type" id="blood_type" value="a"
                            @if ($p['blood_type'] == 'a')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="blood_type">
                                A
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blood_type" id="b" value="b"
                            @if ($p['blood_type'] == 'b')
                                checked
                            @endif>
                            <label class="form-check-label" for="blood_type">
                                B
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blood_type" id="blood_type" value="ab"
                            @if ($p['blood_type'] == 'ab')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="blood_type">
                                AB
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="blood_type" id="o" value="o"
                            @if ($p['blood_type'] == 'o')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="blood_type">
                                O
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row m-2">
                    <label for="religion" class="col-sm-2 col-form-label">Agama</label>
                    <div class="col-sm-6 ml-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="religion" id="religion" value="Islam"
                            @if ($p['religion'] == 'Islam')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="religion">
                                Islam
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="religion" id="kristen" value="Kristen"
                            @if ($p['religion'] == 'Kristen')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="religion">
                                Kristen
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="religion" id="religion" value="Hindu"
                            @if ($p['religion'] == 'Hindu')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="religion">
                                Hindu
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="religion" id="budha" value="Budha"
                            @if ($p['religion'] == 'Budha')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="religion">
                                Budha
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="religion" id="konghuchu" value="Konghuchu"
                            @if ($p['religion'] == 'Konghuchu')
                                checked
                            @endif
                            >
                            <label class="form-check-label" for="religion">
                                Konghuchu
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-end m-4">
                    <button type="submit" class="btn btn-primary m-2">Submit</button>
                    <a href="{{ route('receptionist.patient') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection


