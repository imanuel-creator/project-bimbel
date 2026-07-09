<?php

include "config/koneksi.php";

$data = mysqli_query($koneksi,"SELECT * FROM users");

while($d=mysqli_fetch_assoc($data)){

    $hash=password_hash($d['password'],PASSWORD_DEFAULT);

    mysqli_query($koneksi,"
    UPDATE users
    SET password='$hash'
    WHERE id_user=".$d['id_user']);

}

echo "Semua password berhasil di-hash";