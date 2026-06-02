<?php
include 'koneksi.php';

$warga = mysqli_query($koneksi, "SELECT * FROM warga");

$data = mysqli_query($koneksi,
"SELECT pembayaran.*, warga.nama
FROM pembayaran
JOIN warga ON pembayaran.warga_id = warga.id");
?>

<!DOCTYPE html>
<html>
<head>

<title>Pembayaran</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background: #f4f6f9;
}

.card{
    border-radius: 20px;
}

</style>

</head>
<body>

<div class="container mt-5">

    <div class="card shadow border-0">

        <div class="card-body">

            <h1 class="text-center text-success mb-4">

            <i class="fa-solid fa-money-bill"></i>

            PEMBAYARAN IURAN

            </h1>

            <a href="dashboard.php"
            class="btn btn-success mb-4">

            <i class="fa-solid fa-arrow-left"></i>

            Dashboard

            </a>

            <form method="POST">

                <div class="mb-3">

                    <label>Nama Warga</label>

                    <select name="warga_id"
                    class="form-control">

                    <?php while($w = mysqli_fetch_array($warga)){ ?>

                    <option value="<?php echo $w['id']; ?>">

                    <?php echo $w['nama']; ?>

                    </option>

                    <?php } ?>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Bulan</label>

                    <input type="text"
                    name="bulan"
                    class="form-control">

                </div>

                <div class="mb-3">

                    <label>Nominal</label>

                    <input type="number"
                    name="nominal"
                    class="form-control">

                </div>

                <button type="submit"
                name="simpan"
                class="btn btn-primary">

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Pembayaran

                </button>

            </form>

            <hr>

            <table class="table table-bordered table-striped">

                <tr class="table-success">

                    <th>No</th>
                    <th>Nama</th>
                    <th>Bulan</th>
                    <th>Nominal</th>
                    <th>Status</th>

                </tr>

                <?php
                $no = 1;

                while($d = mysqli_fetch_array($data)){
                ?>

                <tr>

                    <td><?php echo $no++; ?></td>

                    <td><?php echo $d['nama']; ?></td>

                    <td><?php echo $d['bulan']; ?></td>

                    <td>

                    Rp
                    <?php echo number_format($d['nominal']); ?>

                    </td>

                    <td>

                    <span class="badge bg-success">

                    Lunas

                    </span>

                    </td>

                </tr>

                <?php } ?>

            </table>

        </div>

    </div>

</div>

</body>
</html>

<?php

if(isset($_POST['simpan'])){

    $warga_id = $_POST['warga_id'];
    $bulan = $_POST['bulan'];
    $nominal = $_POST['nominal'];

    mysqli_query($koneksi,
    "INSERT INTO pembayaran VALUES(
    '',
    '$warga_id',
    '$bulan',
    '$nominal',
    NOW()
    )");

    echo "
    <script>
    alert('Pembayaran berhasil');
    window.location='pembayaran.php';
    </script>
    ";
}
?>