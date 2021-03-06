<?php
class SignupController extends Controller {
    
    public function actform($url){
        
        $now=time();
        $find=$this->model("event");
        $Date=$find->searchEventDate($url);
        $Date1=strtotime($Date[0]);
        $Date2=strtotime($Date[1]);
        if(($Date1<$now)&&($now<$Date2)){//沒在報名期間不能進入報名
            $info=$find->findEventInfo($url);
            $this->view("showSignupView",$info);
            if($info['withParner']){//如果可攜伴
                $limitNum=3;
                $this->view("showParnerInput",$limitNum);
            }
            $this->view("echoform");
        }else{
             $this->view("alertMsg","TIME OUT");
             header("Refresh:0;/Active/Login/gotoW/b");
        }
        
    }//載入活動參加頁面
    
    public function act(){
        if($_POST){
            $eventID=$_POST['eventID'];
            $parnerNum=$_POST['parnerNum'];
            $go=$this->model("event");   
            $msg=$go->signup($eventID,$parnerNum);
            $this->view("alertMsg",$msg);
            header("Refresh:0;/Active/Login/gotoW/b");
        }
        
    }//參加作業
    
    public function act_authority(){
        
        if($_POST['eventAuthority']){
        $result=($_POST['eventAuthority']);
            foreach($result as $empID){
                $eventID=$_POST['eventID'];
                $goset=$this->model("authority");
                $msg=$goset->setAuthority($empID,$eventID);
                if($msg==false){
                    $this->view("alertMsg","ERROR");
                    header("Refresh:0;/Active/Login/gotoW/a");
                }else{
                    header("Refresh:0;/Active/Login/gotoW/a");
                }
            }
 
        }else{
            $this->view("alertMsg","ERROR");
            header("Refresh:0;/Active/Login/gotoW/a");
        }
    }
    
}
?>