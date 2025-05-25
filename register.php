<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
</head>
<body>
    <h1><b>ĐĂNG KÝ</b></h1>  

    <form method="POST">
        Tên: <input type="text" name="ten" required> <br>
        Tên đăng nhập: <input type="text" name="ten_dang_nhap" required> <br>
        Mật khẩu: <input type="password" name="mat_khau" required> <br>

        Giới tính:
        <select name="gioi_tinh">
            <option>Nam</option>
            <option>Nữ</option>
            <option>Khác</option>
        </select> <br>

        Email: <input type="email" name="email" required> <br>
        Địa chỉ: <input type="text" name="dia_chi"> <br>
        Số điện thoại: <input type="text" name="so_dien_thoai"> <br>
        <button type="submit">Gửi</button>
    </form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Thông tin kết nối MySQL
    $may_chu = 'localhost';
    $csdl = 'user_TH';
    $ten_nguoi_dung = 'root';
    $mat_khau_csd = 'H!!h123@5';
    $ket_noi = new mysqli($may_chu, $ten_nguoi_dung, $mat_khau_csd, $csdl);

    // Kiểm tra kết nối
    if ($ket_noi->connect_error) {
        die("Kết nối thất bại: " . $ket_noi->connect_error);
    }

    // Lấy dữ liệu từ form
    $ten = $_POST['ten'];
    $ten_dang_nhap = $_POST['ten_dang_nhap'];
    $mat_khau = $_POST['mat_khau'];
    $gioi_tinh = $_POST['gioi_tinh'];
    $email = $_POST['email'];
    $dia_chi = $_POST['dia_chi'];
    $so_dien_thoai = $_POST['so_dien_thoai'];

    // Mã hóa mật khẩu
    $mat_khau_bam = password_hash($mat_khau, PASSWORD_DEFAULT);

    // Kiểm tra tên đăng nhập hoặc email đã tồn tại chưa
    $sql = "SELECT * FROM users WHERE username = '$ten_dang_nhap' OR email = '$email'";
    $ket_qua = mysqli_query($ket_noi, $sql);

    if (mysqli_num_rows($ket_qua) > 0) {
        echo "<p style='color:red;'>Tên đăng nhập hoặc Email đã được sử dụng.</p>";
    } else {
        // Thêm dữ liệu mới
        $sql_them = "INSERT INTO users (username, password, name, gender, email, address, phone)
                      VALUES ('$ten_dang_nhap', '$mat_khau_bam', '$ten', '$gioi_tinh', '$email', '$dia_chi', '$so_dien_thoai')";
        
        if (mysqli_query($ket_noi, $sql_them)) {
            echo "<p style='color:green;'>Đăng ký thành công! <a href='login.php'>Đăng nhập</a></p>";
        } else {
            echo "<p style='color:red;'>Lỗi khi thêm vào database: " . mysqli_error($ket_noi) . "</p>";
        }
    }

    // Đóng kết nối
    mysqli_close($ket_noi);
}
?>
</body>
</html>
