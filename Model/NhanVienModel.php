<?php
include_once("Entity_NV.php");

class Model_NhanVien
{
    private $cnn;
    public function __construct()
    {
        include_once("../Config/configDB.php");
        $this->cnn = mysqli_connect($DB_URL, $DB_Username, $DB_Password) or die("Khong the ket noi database");
        mysqli_select_db($this->cnn, $DB_Database);
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

    public function getDetailNhanVien($NhanVienID)
    {
        $sql = "SELECT * FROM nhanvien WHERE IDNV = ?";
        $stmt = mysqli_prepare($this->cnn, $sql);

        // Bind parameter
        mysqli_stmt_bind_param($stmt, "s", $NhanVienID);

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

        $nhanviens = null;

        while ($row = mysqli_fetch_array($result)) {
            $IDNV = $row['IDNV'];
            $Hoten = $row['Hoten'];
            $IDPB = $row['IDPB'];
            $Diachi = $row['Diachi'];
        }

        $nhanviens = new Entity_NhanVien($IDNV, $Hoten, $IDPB, $Diachi);
        return $nhanviens;
    }
    public function addNhanVien($IDNV, $Hoten, $IDPB, $Diachi)
    {
        $sql = "INSERT INTO nhanvien (IDNV, Hoten, IDPB, Diachi) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($this->cnn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssss", $IDNV, $Hoten, $IDPB, $Diachi);
            if (mysqli_stmt_execute($stmt)) {
                return;
            } else {
                die("Lỗi truy vấn: " . mysqli_error($this->cnn));
            }
        } else {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }
    }
    public function getNVbyPB($IDPB)
    {
        $sql = "SELECT * FROM nhanvien WHERE IDPB = ?";
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
    public function deleteNhanVien($IDNV)
    {
        $sql = "Delete from nhanvien where IDNV = ?";
        $stmt = mysqli_prepare($this->cnn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $IDNV);
            if (mysqli_stmt_execute($stmt)) {
                return;
            } else {
                die("Lỗi truy vấn: " . mysqli_error($this->cnn));
            }
        } else {
            die("Lỗi truy vấn: " . mysqli_error($this->cnn));
        }
    }
    public function TimKiemNV($selectedOption, $searchData)
    {
        $sql = "SELECT * FROM nhanvien WHERE $selectedOption LIKE ?";
        $stmt = mysqli_prepare($this->cnn, $sql);

        // Bind parameter
        $searchData = "%$searchData%"; // Add wildcards to the search data
        mysqli_stmt_bind_param($stmt, "s", $searchData);

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
}
