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
                $msg=$go->insertEvent($eventName,$eventStarttime,$eventEndtime,$peopleNum,$withParner);
                $this->view("alertMsg",$msg);
                header("Refresh:0;/Active/");
            }
        }
    }
    function show(){
          $search=$this->model("event");
          $eventinfo=$search->showevent();
          $allEventID=$search->findAllEventID();
          $data=array();
           foreach($allEventID as $a=>$b){
              foreach($b as $k=>$eventID){
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
        
    function showAllemployee(){
        $search=$this->model("event");
        $result=$search->searchAllemployee();
        $this->view("foreachEmployee",$result);
    }//選擇誰能參加    
}
?>