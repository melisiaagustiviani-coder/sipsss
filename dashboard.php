<?php
session_start();

if(!isset($_SESSION['nama'])){

    header("Location:index.php");
}

include 'koneksi.php';

$id = $_SESSION['id'];

$warga = mysqli_query($koneksi,
"SELECT * FROM warga
WHERE id='$id'");

$data = mysqli_fetch_array($warga);

$bulan = [
"Januari",
"Februari",
"Maret",
"April",
"Mei",
"Juni",
"Juli",
"Agustus",
"September",
"Oktober",
"November",
"Desember"
];

$total_lunas = mysqli_num_rows(
mysqli_query($koneksi,
"SELECT * FROM pembayaran
WHERE warga_id='$id'")
);

$progress = ($total_lunas / 12) * 100;
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background:#eef2f7;
    font-family: Arial;
}

.sidebar{
    width:250px;
    height:100vh;
    background:linear-gradient(
    180deg,
    #198754,
    #145c32
    );
    position:fixed;
    padding-top:30px;
}

.sidebar h2{
    color:white;
    text-align:center;
    margin-bottom:40px;
}

.sidebar a{
    display:block;
    color:white;
    padding:15px 25px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover{
    background:white;
    color:#198754;
}

.content{
    margin-left:260px;
    padding:30px;
}

.card{
    border:none;
    border-radius:20px;
}

.profile{
    width:90px;
    height:90px;
    border-radius:50%;
    background:#198754;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:40px;
    margin:auto;
}

.table{
    background:white;
    border-radius:20px;
    overflow:hidden;
}

.badge{
    padding:10px;
    font-size:14px;
}

</style>

</head>
<body>

<div class="sidebar">

    <h2>
    <i class="fa-solid fa-trash"></i>
    SIPS
    </h2>

    <a href="#">
    <i class="fa-solid fa-house"></i>
    Dashboard
    </a>

    <a href="#">
    <i class="fa-solid fa-user"></i>
    Profil
    </a>
    <a href="pengaduan.php">

<i class="fa-solid fa-message"></i>

Pengaduan

</a>
    <a href="logout.php">
    <i class="fa-solid fa-right-from-bracket"></i>
    Logout
    </a>

</div>

<div class="content">

    <div class="row">

        <div class="col-md-4">

            <div class="card shadow p-4 text-center">

                <div class="profile">

                <i class="fa-solid fa-user"></i>

                </div>

                <h3 class="mt-3">

                <?php echo $_SESSION['nama']; ?>

                </h3>

                <p>
                Rumah :
                <?php echo $data['rumah']; ?>
                </p>

            </div>

        </div>

        <div class="col-md-8">

            <div class="card shadow p-4">

                <h3>

                Progress Pembayaran

                </h3>

                <div class="progress mb-3"
                style="height:30px;">

                    <div class="progress-bar
                    bg-success"

                    style="
                    width:
                    <?php echo $progress; ?>%;
                    ">

                    <?php echo round($progress); ?>%

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="card bg-success
                        text-white p-3">

                            <h5>
                            Sudah Dibayar
                            </h5>

                            <h2>
                            <?php echo $total_lunas; ?>
                            Bulan
                            </h2>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card bg-danger
                        text-white p-3">

                            <h5>
                            Belum Dibayar
                            </h5>

                            <h2>
                            <?php echo 12 - $total_lunas; ?>
                            Bulan
                            </h2>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <br>

    <div class="card shadow p-4">

        <h3 class="mb-4">

        Status Pembayaran

        </h3>

        <table class="table table-hover">

            <tr class="table-success">

                <th>Bulan</th>
                <th>Status</th>
                <th>Aksi</th>

            </tr>

            <?php foreach($bulan as $b){ ?>

            <tr>

                <td>
                <?php echo $b; ?>
                </td>

                <td>

                <?php

                $cek = mysqli_query($koneksi,
                "SELECT * FROM pembayaran
                WHERE warga_id='$id'
                AND bulan='$b'");

                if(mysqli_num_rows($cek) > 0){

                    echo "
                    <span class='badge bg-success'>
                    Lunas
                    </span>";

                }else{

                    echo "
                    <span class='badge bg-danger'>
                    Belum Bayar
                    </span>";
                }

                ?>

                </td>

                <td>

                <?php

                if(mysqli_num_rows($cek) == 0){
                ?>

                <a href='bayar.php?bulan=<?php echo $b; ?>'
                class='btn btn-primary btn-sm'>

                Bayar

                </a>

                <?php }else{

                    echo "-";

                } ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

    <br>

    <div class="card shadow p-4">

        <h3 class="mb-4">

        Riwayat Pembayaran

        </h3>

        <table class="table table-bordered">

            <tr class="table-primary">

                <th>Bulan</th>
                <th>Nominal</th>
                <th>Tanggal Bayar</th>

            </tr>

            <?php

            $riwayat = mysqli_query($koneksi,
            "SELECT * FROM pembayaran
            WHERE warga_id='$id'");

            while($r = mysqli_fetch_array($riwayat)){
            ?>

            <tr>

                <td>
                <?php echo $r['bulan']; ?>
                </td>

                <td>
                Rp
                <?php echo number_format($r['nominal']); ?>
                </td>

                <td>
                <?php echo $r['tanggal_bayar']; ?>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>