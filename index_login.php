<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý nhân sự</title>
  <style>
    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      width: 200px;
      background-color: #f1f1f1;
    }

    li a {
      display: block;
      color: #000;
      padding: 8px 16px;
      text-decoration: none;
    }

    li a:hover {
      background-color: #555;
      color: white;
    }
  </style>
</head>

<body>
  <ul>
    <li><a href="./NhanVienController.php?action=getPageAllNhanVien">Xem thông tin nhân viên</a></li>
    <li><a href="./NhanVienController.php?action=getPageAddNewNhanVien">Thêm nhân viên</a></li>
    <li><a href="./NhanVienController.php?action=getPagedeleteNV">Xóa nhân viên</a></li>
    <li><a href="./NhanVienController.php?action=getPageTimKiemNV">Tìm kiếm nhân viên</a></li>
    <li><a href="./PhongBanController.php?action=getPageAllPhongBan">Xem thông tin phòng ban</a></li>
    <li><a href="./PhongBanController.php?action=getPageAddNewPhongBan">Thêm phòng ban</a></li>
    <li><a href="./PhongBanController.php?action=getPageCapNhatPB">Cập nhật phòng ban</a></li>
    <li><a href="./AdminController.php?action=logOut">Đăng xuất</a></li>
  </ul>

</body>

</html>