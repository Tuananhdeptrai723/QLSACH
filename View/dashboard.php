<?php
session_start();
if ($_SESSION["Login"] == false)
    header("location: login.html");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $_SESSION["Login"] = false;
    header("location: login.html");
}
// Kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay đổi thành tên máy chủ cơ sở dữ liệu của bạn
$username = "root"; // Thay đổi thành tên người dùng cơ sở dữ liệu của bạn
$password = ""; // Thay đổi thành mật khẩu cơ sở dữ liệu của bạn
$dbname = "quanlysach"; // Thay đổi thành tên cơ sở dữ liệu của bạn

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng "Sach"
$sql = "SELECT MaSach, TenSach, SoLuong FROM Sach";
$result = $conn->query($sql);

?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h2>Đã đăng nhập thành công</h2>
    <form action="dashboard.php" method="post">
            <button class="logoutBtn" type="submit">Log out</button>
    </form>

    <h2>Danh sách sách</h2>
    <table>
        <tr>
            <th>Mã Sách</th>
            <th>Tên Sách</th>
            <th>Số Lượng</th>
        </tr>
        <?php
        // Hiển thị dữ liệu từ kết quả truy vấn
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["MaSach"] . "</td>";
                echo "<td>" . $row["TenSach"] . "</td>";
                echo "<td>" . $row["SoLuong"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>

    
</body>
</html>