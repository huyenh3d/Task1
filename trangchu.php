<?php
session_start();
if (!isset($_SESSION['ten_dang_nhap'])) {
    header("Location: dangnhap.php");
    exit();
}

include 'connect.php';

$ten_dang_nhap = $_SESSION['ten_dang_nhap'];

$sql = "SELECT * FROM users WHERE username='$ten_dang_nhap'";
$ket_qua = mysqli_query($ket_noi, $sql);

if (mysqli_num_rows($ket_qua) == 1) {
    $user = mysqli_fetch_assoc($ket_qua);
} else {
    echo "Không tìm thấy người dùng.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
</head>
<body>
    <h1>Chào mừng <?php echo $user['name']; ?> đến trang chủ</h1>
    <p>Giới tính: <?php echo $user['gender']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Địa chỉ: <?php echo $user['address']; ?></p>
    <p>Số điện thoại: <?php echo $user['phone']; ?></p>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>
