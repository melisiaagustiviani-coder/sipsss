<?php
include 'koneksi.php';

$data = mysqli_query($koneksi, "SELECT * FROM warga");
?>

<!DOCTYPE html>
<html>
<head>

<title>Data Warga</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<div class="container mt-5">

    <div class="card shadow p-4">

        <h1 class="text-center text-primary">
            DATA WARGA
        </h1>

        <hr>

        <a href="dashboard.php"
        class="btn btn-success mb-3">
        Kembali ke Dashboard
        </a>

        <form method="POST">

            <div class="mb-3">

                <label>Nama Warga</label>

                <input type="text"
                name="nama"
                class="form-control">

            </div>

            <div class="mb-3">

                <label>Nomor Rumah</label>

                <input type="text"
                name="rumah"
                class="form-control">

            </div>

            <button type="submit"
            name="simpan"
            class="btn btn-primary">

            Simpan

            </button>

        </form>

        <hr>

        <table class="table table-bordered table-striped">

            <tr class="table-dark">

                <th>No</th>
                <th>Nama</th>
                <th>Rumah</th>
                <th>Riwayat Pembayaran</th>
                <th>Aksi</th>

            </tr>

            <?php
            $no = 1;

            while($d = mysqli_fetch_array($data)){
            ?>

            <tr>

                <td><?php echo $no++; ?></td>

                <td><?php echo $d['nama']; ?></td>

                <td><?php echo $d['rumah']; ?></td>

                <td>

                <?php

$bayar = mysqli_query($koneksi,
"SELECT * FROM pembayaran
WHERE warga_id='$d[id]'");

while($b = mysqli_fetch_array($bayar)){

    echo "
    <span class='badge bg-success'>
    ".$b['bulan']."
    </span> ";
}

?>
                </td>
                <td>

<a href="hapus_warga.php?id=<?php echo $d['id']; ?>"
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>

<?php

if(isset($_POST['simpan'])){

    $nama = $_POST['nama'];
    $rumah = $_POST['rumah'];

    mysqli_query($koneksi,
    "INSERT INTO warga VALUES(
    '',
    '$nama',
    '$rumah'
    )");

    echo "
    <script>
    alert('Data berhasil disimpan');
    window.location='warga.php';
    </script>
    ";
}
?>