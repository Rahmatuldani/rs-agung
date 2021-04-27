@extends('logistic.layout.app')

@push('head')
<script type="text/javascript">
    var i = 0;

    $("#add-btn-obat").click(function(){
    ++i;

        $("#dynamicAddRemove").append(
            `<tr>
                <td>
                    <input list="medicineList" name="medicine[`+i+`][name]" class="form-control" required>
                    <datalist id="medicineList">
                        @foreach ($medicine as $m)
                            <option value="{{ $m['medicine_name'] }}"></option>
                        @endforeach
                    </datalist>
                </td>
                <td>
                    <input type="text" name="medicine[`+i+`][amount]" class="form-control" required>
                </td>
                <td>
                    <textarea name="medicine[`+i+`][description]" cols="20" rows="3" class="form-control"></textarea>
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


    $("#type").change(function () {
        var inputs = $(this).val();
        if (inputs === 'in') {
            $("#facture").append(
                `<div  class="row m-3" id="fractureId">
                    <label for="fracture_id" class="col-sm-2 col-form-label">No. Fraktur</label>
                    <div class="col-sm-4 ml-3">
                        <input type="text" class="form-control" id="fracture_id" name="fracture_id" required>
                    </div>
                </div>
                <div class="row m-3" id="distId">
                    <label for="dist" class="col-sm-2 col-form-label">Distributor</label>
                    <div class="col-sm-4 ml-3">
                        <input list="distList" name="dist" id="dist" class="form-control" required>
                        <datalist id="distList">
                            @foreach ($dist as $m)
                                <option value="{{ $m['distributor_name'] }}"></option>
                            @endforeach
                        </datalist>
                    </div>
                </div>`
            );
        } else {
            $("#fractureId").remove();
            $("#distId").remove();
        }
    });
</script>

@endpush

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Logistik</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('log.addreport') }}" method="post">
                @csrf
                <div class="row m-3">
                    <label for="type" class="col-sm-2 col-form-label">Jenis</label>
                    <div class="col-sm-4 ml-3">
                        <select name="type" id="type" class="form-control">
                            <option value="out">Barang Keluar</option>
                            <option value="in">Barang Masuk</option>
                        </select>
                    </div>
                </div>
                <div id="facture"></div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th width=15%>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input list="medicineList" name="medicine[0][name]" class="form-control" required>
                                    <datalist id="medicineList">
                                        @foreach ($medicine as $m)
                                            <option value="{{ $m['medicine_name'] }}"></option>
                                        @endforeach
                                    </datalist>
                                </td>
                                <td>
                                    <input type="text" name="medicine[0][amount]" class="form-control" required>
                                </td>
                                <td>
                                    <textarea name="medicine[0][description]" cols="20" rows="3" class="form-control"></textarea>
                                </td>

                                <td>
                                    <button type="button" name="add" id="add-btn-obat" class="btn btn-success">Add More</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row justify-content-end m-2">
                    <button type="submit" class="btn btn-primary m-2">Submit</button>
                    <a href="{{ route('log.report') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


