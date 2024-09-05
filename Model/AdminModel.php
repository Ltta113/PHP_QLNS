<?php
include_once("Entity_Admin.php");

class Model_Admin
{
    private $cnn;
    public function __construct()
    {
        include_once("../Config/configDB.php");
        $this->cnn = mysqli_connect($DB_URL, $DB_Username, $DB_Password) or die("Khong the ket noi database");
        mysqli_select_db($this->cnn, $DB_Database);
    }
    public function DanhNhap($username, $password)
    {
        $sql = "SELECT * FROM admin WHERE username = ? and password = ?";
        $stmt = mysqli_prepare($this->cnn, $sql);

        // Bind parameter
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);

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

        $admin = array();
        while ($row = mysqli_fetch_array($result)) {
            $Id = $row['Id'];
            $username = $row['username'];
            $password = $row['password'];
            $admin[] = new Entity_Admin($Id, $username, $password);
        }
        return $admin;
    }
}