<?php
class SignupController extends Controller {
    
    function actform($url){
        $find=$this->model("event");
        $info=$find->findEventInfo($url);
        $this->view("showSignupView",$info);
        if($info[3]){//如果可攜伴
        $limitNum=3;
        $this->view("showParnerInput",$limitNum);
        }
        $this->view("echoform");
    }//載入活動參加頁面
    
    function act(){
        if($_POST){
            $eventID=$_POST['eventID'];
            $parnerNum=$_POST['parnerNum'];
            $go=$this->model("event");   
            $msg=$go->signup($eventID,$parnerNum);
            $this->view("alertMsg",$msg);
            header("Refresh:0;/Active/");
        }
        
    }//參加作業
}
?>