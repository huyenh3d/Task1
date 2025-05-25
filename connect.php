<?php
$may_chu = 'localhost';
$ten_nguoi_dung = 'root';
$mat_khau_csd = '5';
$csdl = 'user_TH';

$ket_noi = mysqli_connect($may_chu, $ten_nguoi_dung, $mat_khau_csd, $csdl);
if (!$ket_noi) {
    die("Lỗi kết nối: " . mysqli_connect_error());
}
?>
