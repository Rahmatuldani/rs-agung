@extends('pharmacy.layout.app')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Resep obat pasien {{ $patient['patient_name'] }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pharm.cetak', $patient['medrec_id']) }}" method="post" target="__blank">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Batch ID</th>
                                <th>Nama Obat</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th width=15%>Check</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0 ?>
                            @foreach ($bill as $p)
                            <tr>
                                <td>{{ $p['medicine_id'] }}</td>
                                <td>{{ $p['medicine_name'] }}</td>
                                <td>{{ $p['amount'] }}</td>
                                <td>{{ $p['type_name'] }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="moreField[{{$no}}][check]" value="{{$p['medicine_id']}}" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Ada
                                        </label>
                                      </div>
                                </td>
                            </tr>
                            <?php $no+=1 ?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row justify-content-end m-2">
                    <button type="submit" class="btn btn-primary m-2" >Submit</button>
                    <a href="{{ route('pharmacy.index') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


