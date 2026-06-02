<?php
session_start();
include 'koneksi.php';

$id = $_SESSION['id'];

$bulan = $_GET['bulan'];

$warga = mysqli_query($koneksi,
"SELECT * FROM warga
WHERE id='$id'");

$data = mysqli_fetch_array($warga);

if(isset($_POST['bayar'])){

    mysqli_query($koneksi,
    "INSERT INTO pembayaran VALUES(
    '',
    '$id',
    '$bulan',
    '50000',
    NOW()
    )");

    echo "
    <script>

    alert('Pembayaran Sukses');

    window.location='dashboard.php';

    </script>
    ";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Pembayaran</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f4f6f9;
}

.card{
    border-radius:20px;
}

</style>

</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h2 class="text-success text-center mb-4">

                    PEMBAYARAN IURAN

                    </h2>

                    <table class="table table-bordered">

                        <tr>
                            <th>Nama</th>
                            <td>
                            <?php echo $data['nama']; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Nomor Rumah</th>
                            <td>
                            <?php echo $data['rumah']; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Bulan</th>
                            <td>
                            <?php echo $bulan; ?>
                            </td>
                        </tr>

                        <tr>
                            <th>Nominal</th>
                            <td>
                            Rp 50.000
                            </td>
                        </tr>

                    </table>

                    <form method="POST">

                        <button type="submit"
                        name="bayar"
                        class="btn btn-success w-100">

                        Bayar Sekarang

                        </button>

                    </form>

                    <br>

                    <a href="dashboard.php"
                    class="btn btn-secondary w-100">

                    Kembali

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>