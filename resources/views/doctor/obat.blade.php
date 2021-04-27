@extends('doctor.layout.app')

@push('head')
<script type="text/javascript">
    var i = 0;
    $("#add-btn").click(function(){
        ++i;

        $("#dynamicAddRemove").append(
            `<tr>
                <td>
                    <input list="medicineList" name="moreFields[`+i+`][medicine]" id="medicine" class="form-control" required>
                        <datalist id="medicineList">
                            @foreach ($medicine as $m)
                                <option value="{{ $m['medicine_name'] }}"></option>
                            @endforeach
                        </datalist>
                </td>
                <td>
                    <input type="text" name="moreFields[`+i+`][amount]" class="form-control" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-tr">Remove</button>
                </td>
            </tr>`
            );
    });

    $(document).on('click', '.remove-tr', function(){
        $(this).parents('tr').remove();
    });
</script>
@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Obat Pasien {{ $patient['patient_name'] }}</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('doc.setobat', [$patient['patient_id'], Route::input('medrec')]) }}" method="post">
                @csrf
                <table class="table table-bordered" id="dynamicAddRemove">
                    <thead>
                        <tr>
                            <td>Nama Obat</td>
                            <td>Jumlah Obat</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input list="medicineList" name="moreFields[0][medicine]" id="medicine" class="form-control" required>
                                    <datalist id="medicineList">
                                        @foreach ($medicine as $m)
                                            <option value="{{ $m['medicine_name'] }}"></option>
                                        @endforeach
                                    </datalist>
                            </td>
                            <td>
                                <input type="text" name="moreFields[0][amount]" class="form-control" required>
                            </td>
                            <td>
                                <button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="row justify-content-end m-4">
                    <button type="submit" class="btn btn-primary m-2">Submit</button>
                    <a href="{{ route('doctor.index') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

