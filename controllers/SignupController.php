<?php
class SignupController extends Controller {
    
    function actform($url){
        $find=$this->model("event");
        $info=$find->findEventInfo($url);
        $this->view("showSignupView",$info);
        if($info[3]){
        $this->view("echoParnerInput");
        }
        
    }//載入活動參加頁面
    
    function act(){
        if($_POST){
            $eventID=$_POST['eventID'];
            $go=$this->model("event");   
            $msg=$go->signup($eventID);
            $this->view("alertMsg",$msg);
            header("Refresh:0;/Active/");
        }
        
    }//參加作業
}
?>