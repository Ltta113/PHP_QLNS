<?php
include_once("Entity_PB.php");
include_once("Entity_NV.php");

class Model_PhongBan
{
    private $cnn;
    public function __construct()
    {
        include_once("../Config/configDB.php");
        $this->cnn = mysqli_connect($DB_URL, $DB_Username, $DB_Password) or die("Khong the ket noi database");
        mysqli_select_db($this->cnn, $DB_Database);
    }
    public function getAllPhongBan()
    {
        $sql = "SELECT * FROM phongban";
        $result = mysqli_query($this->cnn, $sql);

        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }

        $phongbans = array();
        while ($row = mysqli_fetch_array($result)) {
            $IDPB = $row['IDPB'];
            $Tenpb = $row['Tenpb'];
            $Mota = $row['Mota'];
            $phongbans[] = new Entity_PhongBan($IDPB, $Tenpb, $Mota);
        }
        return $phongbans;
    }
    public function getAllNhanVien()
    {
        $sql = "SELECT * FROM nhanvien";
        $result = mysqli_query($this->cnn, $sql);

        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }

        $nhanviens = array();
        while ($row = mysqli_fetch_array($result)) {
            $IDNV = $row['IDNV'];
            $Hoten = $row['Hoten'];
            $IDPB = $row['IDPB'];
            $Diachi = $row['Diachi'];
            $nhanviens[] = new Entity_NhanVien($IDNV, $Hoten, $IDPB, $Diachi);
        }
        return $nhanviens;
    }
    public function addPhongBan($IDPB, $Tenpb, $Mota){
        $sql = "INSERT INTO phongban (IDPB, Tenpb, Mota) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($this->cnn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $IDPB, $Tenpb, $Mota);
            if (mysqli_stmt_execute($stmt)) {
                return;
            } else {
                die("Lỗi truy vấn: " . mysqli_error($this->cnn));
            }
        } else {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }
    }
    public function getPBByIDPB($IDPB)
    {
        $sql = "SELECT * FROM phongban WHERE IDPB = ?";
        $stmt = mysqli_prepare($this->cnn, $sql);

        // Bind parameter
        mysqli_stmt_bind_param($stmt, "s", $IDPB);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }

        if (mysqli_num_rows($result) == 0) {
            return null;
        }

        $phongban = null;

        while ($row = mysqli_fetch_array($result)) {
            $IDPB = $row['IDPB'];
            $Tenpb = $row['Tenpb'];
            $Mota = $row['Mota'];
        }

        $phongban = new Entity_PhongBan($IDPB, $Tenpb, $Mota);
        return $phongban;
    }
    public function CapNhatPhongBan($IDPB, $Tenpb, $Mota)
    {
        $sql = "UPDATE phongban SET Tenpb = ?,Mota = ?  WHERE IDPB = ?";
        $stmt = mysqli_prepare($this->cnn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $Tenpb, $Mota, $IDPB);
            if (mysqli_stmt_execute($stmt)) {
                return;
            } else {
                die("Lỗi truy vấn: " . mysqli_error($this->cnn));
            }
        } else {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }
    }
}