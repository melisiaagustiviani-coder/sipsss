<?php

$koneksi = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_sampah"
);

if(!$koneksi){
    die("Koneksi gagal");
}

?>