<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập </title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <form method="POST">
        Tên đăng nhập: <input type="text" name="ten_dang_nhap" required><br>
        Mật khẩu: <input type="password" name="mat_khau" required><br>
        <button type="submit">Đăng nhập</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $may_chu = 'localhost';
    $ten_nguoi_dung = 'root';
    $mat_khau_csd = ''; 
    $csdl = 'user_TH';

    $ket_noi = mysqli_connect($may_chu, $ten_nguoi_dung, $mat_khau_csd, $csdl);
    if (!$ket_noi) {
        die("Lỗi kết nối: " . mysqli_connect_error());
    }

    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $mat_khau = $_POST['mat_khau'];

    
    $sql = "SELECT * FROM users WHERE username='$ten_dang_nhap' AND password='$mat_khau'";
    $ket_qua = mysqli_query($ket_noi, $sql);

    if (mysqli_num_rows($ket_qua) == 1) {
        $user = mysqli_fetch_assoc($ket_qua);
        echo "<p style='color:green;'>Đăng nhập thành công!</p>";
        echo "Tên: " . $user['name'] . "<br>";
        echo "Giới tính: " . $user['gender'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Địa chỉ: " . $user['address'] . "<br>";
        echo "Số điện thoại: " . $user['phone'] . "<br>";
    } else {
        echo "<p style='color:red;'>Tên đăng nhập hoặc mật khẩu sai!</p>";
    }

    mysqli_close($ket_noi);
}
?>
</body>
</html>
