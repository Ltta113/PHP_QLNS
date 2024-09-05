<?php
include_once("BaseController.php");
include_once("../Model/NhanVienModel.php");
include_once("../Model/PhongBanModel.php");
class NhanVienController extends BaseController
{
        public function __construct()
        {
        }
        public function getPageAllNhanVien()
        {
                $modelNV = new Model_NhanVien();
                $listNhanVien = $modelNV->getAllNhanVien();
                return  $this->View("../View/ListNhanVien.html", [
                        'listNhanVien' => $listNhanVien
                ]);
        }
        public function getDetailNV()
        {
                $idNV = $_REQUEST['nvid'];
                $modelNV = new Model_NhanVien();
                $detailNV = $modelNV->getDetailNhanVien($idNV);
                return $this->view("../View/DetailNhanVien.html", [
                        'detailNV' => $detailNV
                ]);
        }
        public function getPageAddNewNhanVien()
        {
            $modelPB = new Model_PhongBan();
            $listPhongBan = $modelPB->getAllPhongBan();
            $listNhanVien = $modelPB->getAllNhanVien();
            return  $this->view("../View/AddNewNhanVien.html", [
                'listPhongBan' => $listPhongBan,
                'listNhanVien' => $listNhanVien
            ]);
        }
        public function addNewNV()
        {
                $modelNV = new Model_NhanVien();
                $IDNV = $_REQUEST['IDNV'];
                $Hoten = $_REQUEST['Hoten'];
                $IDPB = $_REQUEST['IDPB'];
                $Diachi = $_REQUEST['Diachi'];
                $listNhanVien = $modelNV->getDetailNhanVien($IDNV);
                $modelNV->addNhanVien($IDNV, $Hoten, $IDPB, $Diachi);
                $listNhanVien = $modelNV->getAllNhanVien();
                return  $this->View("../View/ListNhanVien.html", [
                        'listNhanVien' => $listNhanVien
                ]);
        }
        public function getPagedeleteNV()
        {
                $modelNV = new Model_NhanVien();
                $listNhanVien = $modelNV->getAllNhanVien();
                return  $this->View("../View/DeleteNhanVien.html", [
                        'listNhanVien' => $listNhanVien
                ]);
        }
        public function DeleteNV()
        {
                $modelNV = new Model_NhanVien();
                $IDNV = $_REQUEST['nvid'];
                $modelNV->deleteNhanVien($IDNV);
                $listNhanVien = $modelNV->getAllNhanVien();
                return  $this->view("../View/DeleteNhanVien.html", [
                        'listNhanVien' => $listNhanVien
                ]);
        }
        public function DeleteNVs()
        {
                if (isset($_POST['selectedIDs'])) {
                        $selectedIDs = $_POST['selectedIDs'];
                        $modelNV = new Model_NhanVien();
                        foreach ($selectedIDs as $IDNV) {
                                // Thực hiện truy vấn xóa nhân viên có IDNV tương ứng
                                $modelNV->deleteNhanVien($IDNV);
                        }
                }
                $listNhanVien = $modelNV->getAllNhanVien();
                return  $this->view("../View/DeleteNhanVien.html", [
                        'listNhanVien' => $listNhanVien
                ]);
        }
        public function getPageTimKiemNV()
        {
                return $this->view("../View/TimKiemNhanVien.html");
        }
        public function TimKiemNhanVien()
        {
                $selectedOption = $_POST["check"];
                $searchData = $_POST["data"];
                $modelNV = new Model_NhanVien();  
                $listNhanVien = $modelNV->TimKiemNV($selectedOption,$searchData);
                return  $this->view("../View/ListNhanVien.html", [
                        'listNhanVien' => $listNhanVien
                ]);
        }
}
$nvController = new NhanVienController();
$actionName = $_REQUEST['action'];
$nvController->$actionName();
