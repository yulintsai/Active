<?php
class SignupController extends Controller {
    
    function actform($url){
        
        $now=time();
        
        //echo $now;
        $find=$this->model("event");
        
        $Date=$find->searchEventDate($url);
        $Date1=strtotime($Date[0]);
        $Date2=strtotime($Date[1]);
        if(($Date1<$now)&&($now<$Date2)){//如果報名時間到
            $info=$find->findEventInfo($url);
            $this->view("showSignupView",$info);
            if($info[3]){//如果可攜伴
                $limitNum=3;
                $this->view("showParnerInput",$limitNum);
            }
            $this->view("echoform");
        }else{
             $this->view("alertMsg","TIME OUT");//如果時間還沒到
             header("Refresh:0;/Active/Login/gotoW/b");
        }
        
    }//載入活動參加頁面
    
    function act(){
        if($_POST){
            $eventID=$_POST['eventID'];
            $parnerNum=$_POST['parnerNum'];
            $go=$this->model("event");   
            $msg=$go->signup($eventID,$parnerNum);
            $this->view("alertMsg",$msg);
            header("Refresh:0;/Active/Login/gotoW/b");
        }
        
    }//參加作業
    
    function act_authority($empSum){
        if($_POST){
            for($a=1;$a<$empSum;$a++){
                if($_POST["$a"]){
                $eventID=$_POST['eventID'];
                $goset=$this->model("authority");
                $msg=$goset->setAuthority($a,$eventID);
                $this->view("alertMsg",$msg);
                header("Refresh:0;/Active/Login/gotoW/a");
                }
            }
        }
    }
    
}
?>