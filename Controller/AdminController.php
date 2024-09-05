<?php
include_once("BaseController.php");
include_once("../Model/AdminModel.php");
class AdminController extends BaseController
{
    public function __construct()
    {
    }
    public function getPageLogin()
    {
        return  $this->View("../View/Login.html");
    }
    public function LogIn()
    {
        $modelAdmin = new Model_Admin();
        $username = $_POST["username"];
        $password = $_POST["password"];
        $admin = $modelAdmin->DanhNhap($username, $password);
        if($admin === null)
            return  $this->View("../View/Login.html");
        else return $this->View("../index_login.php");
    }
    public function logOut()
    {
        return  $this->View("../index.php");
    }
}
$adminController = new AdminController();
$actionName = $_REQUEST['action'];
$adminController->$actionName();
