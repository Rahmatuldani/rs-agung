@extends('logistic.layout.app')

@push('head')
<script type="text/javascript">
var i = 0;

$("#add-btn-obat").click(function(){
    ++i;
    $("#dynamicAddRemove").append(
        `<tr>
            <td>
                <input type="text" name="dist[`+i+`][npwp]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="dist[`+i+`][name]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="dist[`+i+`][address]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="dist[`+i+`][phone]" class="form-control" required>
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar Distributor</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('log.pdistributor') }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <thead>
                            <tr>
                                <th>No NPWP</th>
                                <th>Nama Distributor</th>
                                <th>Alamat</th>
                                <th>No Telp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="dist[0][npwp]" class="form-control">
                                </td>
                                <td>
                                    <input type="text" name="dist[0][name]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="dist[0][address]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="dist[0][phone]" class="form-control" required>
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
                    <a href="{{ route('log.vdistributor') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


