<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <style>
        *{
            margin: 10px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        .td{
            border: none;
            border-bottom: 0.5px solid black;
        }

        td{
            padding: 5px;
        }

        .foot{
            float: right;
            margin-right: 40px;
        }
    </style>
</head>
<body>
<pre>
<center>
<h2 style="margin: 0">RUMAH SAKIT AGUNG</h2>
<h5 style="margin: 0">Jalan Sultan Agung No. 67, Jakarta 12970</h5>
<h5 style="margin: 0">Telp. (021) 8294955   Fax. (021) 830 5791</h5>
============================================================================================
</center>
<div>
    Nama Pasien         : {{ $patient['patient_name'] }} <br>
    Nama Dokter         : {{ $doc['name'] }} <br>
    Tanggal Pemeriksaan : {{ date('d F Y', strtotime($medrec['created_at']))}} <br>
    Status Perawatan    : {{$medrec['status']}} <br>
    Pembayaran          : {{$patient['paid_status']}} <br>
</div>
<div>
    Rincian Obat
    <table border="1">
        <thead>
            <tr>
                <td>Nama</td>
                <td width=10%>Jenis</td>
                <td width=6%>Jml</td>
                <td>Harga</td>
                <td>Subtotal</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($bill as $b)
            <tr>
                <td class="td">{{$b['medicine_name']}}</td>
                <td class="td">{{$b['type_name']}}</td>
                <td class="td">{{$b['amount']}}</td>
                <td class="td">{{$b['medicine_price']}}</td>
                <td class="td">{{$b['subtotal']}}</td>
            </tr>
            <?php $total = $total+$b['subtotal'];?>
            @endforeach
        </tbody>
    </table>
</div>

<div style="width: 200px;">
<table>
<tr>
    <td>Obat</td>
    <td>: Rp </td>
    <td align="right">{{$total}}</td>
</tr>
<tr>
    <td>Perawatan</td>
    <td>: Rp </td>
    <td align="right">{{$outpatient}}</td>
</tr>
<tr>
    <td>PPN</td>
    <td>: Rp </td>
    <td align="right"><?php $ppn=1000; echo $ppn; ?></td>
</tr>
<tr>
    <td colspan="3">-------------------------</td>
</tr>
<tr>
    <td>Total</td>
    <td>: Rp </td>
    <td align="right">{{$total + $ppn + $outpatient}}</td>
</tr>
</table>
</div>

<div class="foot">
<center>
Jakarta, <?= date('d F Y') ?><br>

TTD <br>

{{ Auth::user()->name }}
</center>
</div>

</pre>
</body>
</html>
