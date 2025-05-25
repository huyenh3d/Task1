<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['ten_dang_nhap'])) {
    header("Location: dangnhap.php");
    exit();
}

$ten_dang_nhap = $_SESSION['ten_dang_nhap'];

// Giả sử admin có username là "admin"
if ($ten_dang_nhap != "admin") {
    echo "Bạn không có quyền truy cập trang này.";
    exit();
}

// Lấy danh sách tất cả user
$sql = "SELECT * FROM users";
$ket_qua = mysqli_query($ket_noi, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản trị</title>
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Tên</th>
            <th>Giới tính</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
        </tr>
        <?php while ($user = mysqli_fetch_assoc($ket_qua)) { ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['name']; ?></td>
                <td><?php echo $user['gender']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['address']; ?></td>
                <td><?php echo $user['phone']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="logout.php">Đăng xuất</a>
</body>
</html>
