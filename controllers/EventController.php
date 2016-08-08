<?php
class EventController extends Controller {
    
    public function create(){
        
        if($_POST){
            define("HOME","Refresh:0;/Active/Login/gotoW/a");
            $go=0;
            $eventName =$_POST['eventName'];
            $eventTime =$_POST['eventTime'];
            $eventStarttime =$_POST['eventStarttime'];
            $eventEndtime =$_POST['eventEndtime'];
            $peopleNum =$_POST['peopleNum'];
            $withParner=$_POST['withParner'];
            $check=$this->model("dataFilter");
           
            if(($check->checkDatetime($eventTime))==""||($check->checkDatetime($eventStarttime))==""||($check->checkDatetime($eventEndtime))=="")
            {
                $this->view("alertMsg","Datetime Error");
                header(HOME);
            }
            if(!is_numeric($peopleNum))//判斷是否為數字或數字字串
            $this->view("alertMsg","$peopleNum Not interger");
            if($eventName==""||$eventTime==""||$eventStarttime==""||$eventEndtime==""||$peopleNum==""){
                $this->view("alertMsg","some input empty");
                header(HOME);
            }elseif(!is_bool($withParner)) {
                $this->view("alertMsg","攜伴值無法通過驗證");
                header(HOME);
            }else{
                $data=$this->model("dataFilter");
                $eventName=&$data->test_input($eventName);//資料過濾
                $go = $this->model("event");
                $result=$go->insertEvent($eventName,$eventTime,$eventStarttime,$eventEndtime,$peopleNum,$withParner);
                
                if($result=="Set Time Error"){//判斷時間是否正確
                    $this->view("alertMsg",$result);
                    header(HOME);
                }else{
                    $this->view("alertMsg",$result['msg']);
                    $this->showAllemployee($result['eventID']);
                }
            }
        }
    }
    public function show(){
          $search=$this->model("event");
          $allEventID=$search->findAllEventID();//尋找該員工可參加的全部活動
          $data=array();//查詢即時報名的數據
          $eventinfo=array();
          if($allEventID>0){
          foreach($allEventID as $a=>$b){
              foreach($b as $k=>$eventID){
                 array_push($eventinfo,$search->showevent($eventID));
                 $result=$search->countSignup($eventID);
                 $limit=$search->searchEventlimit($eventID);
                 if(($result/$limit)>=1){
                    $showLimit="FULL";
                 }else{
                 $showLimit="$result/$limit";
                 }
                 array_push($data,$showLimit);
              }
          }
             $test=array($eventinfo,$data);
             $this->view("showEvent",$test);
          }    
            
    }

    public function showAllemployee($eventID){
        
            if($eventID){
            $search=$this->model("event");
            $result=$search->searchAllemployee();
            $ans=array($result,$eventID);
            $this->view("foreachEmployee",$ans);
            }else{
            header("Location:/Active/Login/gotoW/a");
            }
    }//選擇誰能參加    
    
}
?>