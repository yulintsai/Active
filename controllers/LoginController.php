<?php
class LoginController extends Controller {
    
    /*==========================================================*/
    
    function index() {
        if(!isset($_SESSION['status'])){
        $this->view("index2");
        }else{
        $this->view("index");
        // $this->view("Front-End");    
        }
    }      //首頁的頁面
    
    /*==========================================================*/
    
    function AddVisitor(){
        $add = $this->model("player");
        $add->addVisitor();
    }  //統計瀏覽人數
    
    function Gologin(){
        
        if(isset($_POST['login'])){
        $account =  $_POST["Account"];
        $password= $_POST["Password"];
        
        $find=$this->model("data");
        $ip=$find->getIP();
        
        $login= $this->model("Login");
        $Errmsg=$login->CheckLogin($account,$password,$ip);
        $this->view("alertMsg",$Errmsg);
        header("Refresh:0;/Active/");
        
        }else{
            
        $this->view("alertMsg",'Error!');
        
        }
    }     //驗證登入資料
    
    function GoSignup(){
        
        $gotosn = $this->model("player");
        $ans=$gotosn->GoSignup();
        $this->view("showOnedata",$ans);
        header("Refresh:0;/EasyMVC/");
        
    }    //進行註冊
    
    function GoEdit(){
        if(isset($_POST['go_edit'])){
        
        if($_POST['Password']=="")
        $ErrorMsg= 'Password empty';
        if($_POST["Username"]=="")
        $ErrorMsg= 'UserName empty';
        if($_POST['Email']=="")
        $ErrorMsg= 'E-mail empty';
        if($_POST['Password']!==$_POST['RePassword']){
        $ErrorMsg= 'Password Not The Same';}
        else{
        $edit=$this->model("edit");
        $msg=$edit->edit();
        $this->view("alertMsg",$msg);
        header("Refresh:0;/EasyMVC/");
        }
        $this->view("alertMsg",$ErrorMsg);
        header("Refresh:0;/EasyMVC/");
        }
    }      //進行編輯
    
    /*==========================================================*/
    
    function loadSignup(){
        $find = $this->model("data");
        $ip=$find->getIP();//找IP
        $this->view("loadSignup",$ip);
    }  //載入註冊畫面
    
    function loadEdit(){
 
        $search = $this->model("data");
        $ip= $search->getIP();//找IP
        $data= $search->searchUserdata();//找Email
        $ans= $search->mergeData($data['email'],$ip);
        $this->view("loadEdit",$ans);

        
    }    //載入編輯畫面
    
    /*==========================================================*/
    
    function logout(){
            $logout = $this->model("Login");
            $msg=$logout->logout();
            $this->view("alertMsg",$msg);
            header("Refresh:0;Location");
    }     //登出
    
}
?>