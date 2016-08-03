<?php
class EventController extends Controller {
    
    function create(){
        
        if($_POST){
            
            $eventName =$_POST['eventName'];
            $eventStarttime =$_POST['eventStarttime'];
            $eventEndtime =$_POST['eventEndtime'];
            $peopleNum =$_POST['peopleNum'];
            $withParner=$_POST['withParner'];
            
            if($eventName==""||$eventStarttime==""||$eventEndtime==""||$peopleNum==""){
                $this->view("alertMsg","some input empty");
                header("Refresh:0;/Active/");
            }else{
                $data=$this->model("dataFilter");
                $eventName=&$data->test_input($eventName);//資料過濾
                $go = $this->model("event");
                $result=$go->insertEvent($eventName,$eventStarttime,$eventEndtime,$peopleNum,$withParner);
                $this->view("alertMsg",$result['msg']);
                $this->showAllemployee($result['eventID']);
                //header("Refresh:0;/Active/");
            }
        }
    }
    function show(){
          $search=$this->model("event");
          
          $allEventID=$search->findAllEventID();//尋找該ID可參加的全部活動
          $data=array();//查詢即時報名的數據
          $eventinfo=array();
           foreach($allEventID as $a=>$b){
              foreach($b as $k=>$eventID){
                 array_push($eventinfo,$search->showevent($eventID));
                 $result=$search->countSignup($eventID);
                 $limit=$search->searchEventlimit($eventID);
                 if(($result/$limit)==1){
                    $showLimit="Full";
                 }else{
                 $showLimit="$result/$limit";
                 }
                 array_push($data,$showLimit);
              }
           }
             $test=array($eventinfo,$data);
             $this->view("showEvent",$test);

    }
    function limit(){
        }
        
    function showAllemployee($eventID){
        $search=$this->model("event");
        $result=$search->searchAllemployee();
        $ans=array($result,$eventID);
        $this->view("foreachEmployee",$ans);
    }//選擇誰能參加    
}
?>