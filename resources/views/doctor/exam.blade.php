@extends('doctor.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan Pasien {{ $patient['patient_name'] }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('doc.medrec', [$patient['patient_id'], $patient['patient_name']]) }}" method="post">
                @csrf
                <div class="row m-2">
                    <label for="complaint" class="col-sm-2 col-form-label">Keluhan</label>
                    <div class="col-sm-9 ml-3">
                        <textarea class="form-control" name="complaint" id="complaint" cols="50" rows="5" required>{{ old('complaint') }}</textarea>
                    </div>
                </div>

                <div class="row m-2 mt-3">
                    <label for="action" class="col-sm-2 col-form-label">Tindakan</label>
                    <div class="col-sm-9 ml-3">
                        <textarea class="form-control" name="action" id="action" cols="50" rows="5" required>{{ old('action') }}</textarea>
                    </div>
                </div>

                <div class="row m-2 mt-3">
                    <label for="stats" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-3 ml-3">
                        <select class="form-control" name="stats" id="stats">
                            <option value="Rawat Jalan">Rawat Jalan</option>
                            <option value="Rawat Inap">Rawat Inap</option>
                        </select>
                    </div>
                </div>

                <div class="row justify-content-end m-4">
                    <button type="submit" class="btn btn-primary m-2">Submit</button>
                    {{-- <a href="#" class="btn btn-success m-2" data-toggle="modal" data-target="#medicineModal">Resep Obat</button> --}}
                    <a href="{{ route('doctor.index') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Medicine Modal-->
    {{-- <div class="modal fade" id="medicineModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Obat untuk pasien {{ $patient['patient_name'] }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="" method="post">
                    @csrf
                    <div class="modal-body">
                        <table class="table table-bordered" id="dynamicAddRemove">
                            <thead>
                                <tr>
                                    <td>Nama Obat</td>
                                    <td>Jumlah Obat</td>
                                    <td>Satuan</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input list="medicineList" name="medicine" id="medicine" class="form-control">
                                            <datalist id="medicineList">
                                                <option value="Paracetamol"></option>
                                            </datalist>
                                    </td>
                                    <td>
                                        <input type="text" name="amount" class="form-control" required>
                                    </td>
                                    <td>
                                        <select name="unit" id="unit" class="form-control">
                                            <option value="#">Strip</option>
                                            <option value="#">Butir</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}

</div>
<!-- /.container-fluid -->
@endsection

