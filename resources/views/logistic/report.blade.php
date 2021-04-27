@extends('logistic.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <a href="{{ route('log.vreport') }}" class="btn btn-outline-success m-3">Tambah Laporan</a>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Laporan Logistik</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No Fraktur</th>
                            <th>User</th>
                            <th>Jenis</th>
                            <th>Distributor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Fraktur</th>
                            <th>User</th>
                            <th>Jenis</th>
                            <th>Distributor</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($report as $m)
                        <tr>
                            <td>
                                @if ($m['fracture_id'] != null)
                                    {{ $m['fracture_id'] }}
                                @else
                                    {{ '-' }}
                                @endif
                            </td>
                            <td>{{ $m['name'] }}</td>
                            <td>
                                @if ($m['type'] == 'in')
                                    {{ 'Barang Masuk' }}
                                @else
                                    {{ 'Barang Keluar' }}
                                @endif
                            </td>
                            <td>
                                {{$m['distributor_name']}}
                            </td>
                            <td>
                                <a href="{{ route('log.listreport', ['fracture' => $m['fracture_id'], 'name' => $m['name'], 'dist' => $m['distributor_name']]) }}" class="btn btn-success" ><i class="fas fa-list"></i></a>
                            </td>
                        </tr>

                        <!-- Edit Modal-->
                        {{-- <div class="modal fade" id="editMedModal-{{ $p['patient_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        </div> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->


@endsection


