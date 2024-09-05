<?php
include_once("BaseController.php");
include_once("../Model/NhanVienModel.php");
include_once("../Model/PhongBanModel.php");
class PhongBanController extends BaseController
{
    public function __construct()
    {
    }
    public function getPageAllPhongBan()
    {
        $modelPB = new Model_PhongBan();
        $listPhongBan = $modelPB->getAllPhongBan();
        return  $this->View("../View/ListPhongBan.html", [
            'listPhongBan' => $listPhongBan
        ]);
    }
    public function getPBbyID()
    {
        $IDPB = $_REQUEST['pbid'];
        $modelPB = new Model_PhongBan();
        $phongBan = $modelPB->getPBByIDPB($IDPB);
        return $this->view("../View/CapNhatPhongBan.html", [
            'phongBan' => $phongBan
        ]);
    }
    public function getNVbyPB()
    {
        $IDPB = $_REQUEST['pbid'];
        $modelPB = new Model_NhanVien();
        $listNhanVien = $modelPB->getNVbyPB($IDPB);
        return $this->view("../View/ListNhanVien.html", [
            'listNhanVien' => $listNhanVien
        ]);
    }
    public function getPageAddNewPhongBan()
    {
        $modelPB = new Model_PhongBan();
        $listPhongBan = $modelPB->getAllPhongBan();
        return  $this->View("../View/AddNewPhongBan.html", [
            'listPhongBan' => $listPhongBan
        ]);
    }
    public function addNewPB()
    {
        $modelPB = new Model_PhongBan();
        $IDPB = $_REQUEST['IDPB'];
        $Tenpb = $_REQUEST['Tenpb'];
        $Mota = $_REQUEST['Mota'];
        $phongBan = $modelPB->getPBByIDPB($IDPB);
        $modelPB->addPhongBan($IDPB, $Tenpb, $Mota);

        $listPhongBan = $modelPB->getAllPhongBan();
        return  $this->View("../View/ListPhongBan.html", [
            'listPhongBan' => $listPhongBan
        ]);
        
    }
    public function getPageCapNhatPB()
    {
        $modelPB = new Model_PhongBan();
        $listPhongBan = $modelPB->getAllPhongBan();
        return  $this->View("../View/PageCapNhatPB.html", [
            'listPhongBan' => $listPhongBan
        ]);
    }
    public function capnhatPB()
    {
        $modelPB = new Model_PhongBan();
        $IDPB = $_REQUEST['IDPB'];
        $Tenpb = $_POST['Tenpb'];
        $Mota = $_REQUEST['Mota'];
        $modelPB->CapNhatPhongBan($IDPB, $Tenpb, $Mota);
        $listPhongBan = $modelPB->getAllPhongBan();
        return  $this->View("../View/ListPhongBan.html", [
            'listPhongBan' => $listPhongBan
        ]);
    }
}
$pbController = new PhongBanController();
$actionName = $_REQUEST['action'];
$pbController->$actionName();
