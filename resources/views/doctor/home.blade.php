@extends('doctor.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pasien hari ini</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width=10%>MedRec</th>
                            <th>Nama Pasien</th>
                            <th>L/P</th>
                            <th>Umur</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th width=10%>MedRec</th>
                            <th>Nama Pasien</th>
                            <th>L/P</th>
                            <th>Umur</th>
                            <th>Status</th>
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
                            <td>{{ $p['status'] }}</td>
                            <td>
                                <a href="{{ route('doc.exam', $p['patient_id']) }}" class="btn btn-success"><i class="fas fa-check"></i></a>
                                <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


