@extends('logistic.layout.app')

@push('head')
<script type="text/javascript">
var i = 0;

$("#add-btn-obat").click(function(){
    ++i;
    $("#dynamicAddRemove").append(
        `<tr>
            <td>
                <input type="text" name="medicine[`+i+`][batch]" class="form-control" required>
            </td>
            <td>
                <input type="text" name="medicine[`+i+`][name]" class="form-control" required>
            </td>
            <td>
                <select name="medicine[`+i+`][type]" class="form-control">
                    @foreach ($type as $t)
                        <option value="{{ $t['type_id'] }}">{{ $t['type_name'] }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="text" name="medicine[`+i+`][price]" class="form-control" required>
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
            <h6 class="m-0 font-weight-bold text-primary">Daftar obat</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('logistic.store') }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered" id="dynamicAddRemove">
                        <thead>
                            <tr>
                                <th width=15%>Batch ID</th>
                                <th>Nama Obat</th>
                                <th>Jenis</th>
                                <th width=20%>Harga</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="medicine[0][batch]" class="form-control" required>
                                </td>
                                <td>
                                    <input type="text" name="medicine[0][name]" class="form-control" required>
                                </td>
                                <td>
                                    <select name="medicine[0][type]" class="form-control">
                                        @foreach ($type as $t)
                                            <option value="{{ $t['type_id'] }}">{{ $t['type_name'] }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="medicine[0][price]" class="form-control" required>
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
                    <a href="{{ route('logistic.index') }}" class="btn btn-danger m-2">Kembali</a>
                </div>
            </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->

@endsection


