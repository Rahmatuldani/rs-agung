<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pasien</title>
    <style>
        *{
            margin: 10px;
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
<center>
<h1 style="margin-top: -60px;">Data Pasien Rumah Sakit Agung</h1>
</center>
Nama Pasien         : {{ $patient['patient_name'] }} <br>
Jenis Kelamin       : {{ $patient['patient_sex'] }} <br>
Tanggal Lahir       : {{ date('d F Y', strtotime($patient['patient_birth']))}} <br>
Agama               : {{$patient['religion']}} <br>
Pekerjaan           : {{$patient['patient_job']}} <br>
Suami/Istri         : {{$patient['patient_partner']}} <br>
Alamat              : {{$patient['patient_address']}} <br>
Golongan Darah      : {{$patient['blood_type']}} <br>
No. Telp.           : {{$patient['patient_phone']}} <br>
Pembayaran          : {{$patient['paid_status']}} <br>
Tanggal Masuk       : {{ date('d F Y', strtotime($patient['created_at']))}} <br>
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
