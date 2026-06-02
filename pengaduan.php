<?php
session_start();
include 'koneksi.php';

$id = $_SESSION['id'];

if(isset($_POST['kirim'])){

    $isi = $_POST['isi'];

    mysqli_query($koneksi,
    "INSERT INTO pengaduan VALUES(
    '',
    '$id',
    '$isi',
    NOW()
    )");

    echo "
    <script>
    alert('Pengaduan berhasil dikirim');
    window.location='pengaduan.php';
    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Pengaduan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#eef2f7;
}

.card{
    border-radius:20px;
}

</style>

</head>
<body>

<div class="container mt-5">

    <div class="card shadow border-0">

        <div class="card-body">

            <h2 class="text-success mb-4">

            Pengaduan Sampah

            </h2>

            <form method="POST">

                <div class="mb-3">

                    <label>Tulis Pengaduan</label>

                    <textarea
                    name="isi"
                    class="form-control"
                    rows="5"></textarea>

                </div>

                <button type="submit"
                name="kirim"
                class="btn btn-success">

                Kirim Pengaduan

                </button>

            </form>

            <hr>

            <h4>Riwayat Pengaduan</h4>

            <table class="table table-bordered">

                <tr class="table-success">

                    <th>Pengaduan</th>
                    <th>Tanggal</th>

                </tr>

                <?php

                $data = mysqli_query($koneksi,
                "SELECT * FROM pengaduan
                WHERE warga_id='$id'");

                while($d = mysqli_fetch_array($data)){
                ?>

                <tr>

                    <td>
                    <?php echo $d['isi_pengaduan']; ?>
                    </td>

                    <td>
                    <?php echo $d['tanggal']; ?>
                    </td>

                </tr>

                <?php } ?>

            </table>

            <a href="dashboard.php"
            class="btn btn-secondary">

            Kembali

            </a>

        </div>

    </div>

</div>

</body>
</html>