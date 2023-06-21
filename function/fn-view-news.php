<?php
include_once "./fn-databese-connect.php";

$query = mysqli_query($conn, "select * from table_news where id order by id desc");
$limitPerPage = 1;
$totalData = mysqli_num_rows($query);
$jumlahPagination = ceil($totalData / $limitPerPage); // hasilnya bisa jadi pecahan atau koma2an 1001 / 100 = 10.01 butuh fungsi ceil selalu pembulatan ke atas = 11 

// mencari limit untuk keperluan pencarian di database
$dataAwal = ($halamanAktif * $limitPerPage) - $limitPerPage; // (1 * 2) - 2 = 0 // (2 * 2) - 2 = 2 // (3 * 2) - 3 = 4
$ambildata_perhalaman = mysqli_query($conn, "select * from table_news where id order by id desc LIMIT $limitPerPage offset $dataAwal");
$dataViewMahasiswa = mysqli_fetch_all($ambildata_perhalaman, MYSQLI_ASSOC);

$jumlahLink = 3;
if ($halamanAktif > $jumlahLink) {
    $start_number = $halamanAktif - $jumlahLink;
} else {
    $start_number = 1;
}

if ($halamanAktif < ($jumlahPagination - $jumlahLink)) {
    $end_number = $halamanAktif + $jumlahLink;
} else {
    $end_number = $jumlahPagination;
}
