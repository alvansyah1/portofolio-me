<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "portfolio"
);

if(!$conn){
    die("Koneksi gagal");
}