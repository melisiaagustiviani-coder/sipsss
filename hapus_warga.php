<?php

include 'koneksi.php';

$id = $_GET['id'];

/* hapus pembayaran dulu */

mysqli_query($koneksi,
"DELETE FROM pembayaran
WHERE warga_id='$id'");

/* lalu hapus warga */

mysqli_query($koneksi,
"DELETE FROM warga
WHERE id='$id'");

header("Location:warga.php");

?>