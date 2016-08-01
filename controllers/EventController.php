<?php
class EventController extends Controller {
    
    function create(){
        
        if($_POST){
            $eventName =$_POST['eventName'];
            $eventStarttime =$_POST['eventStarttime'];
            $eventEndtime =$_POST['eventEndtime'];
            $peopleNum =$_POST['peopleNum'];
            $withParner=$_POST['withParner'];
            $data=$this->model("dataFilter");
            $eventName=&$data->test_input($eventName);//資料過濾
            $go = $this->model("event");
            $msg=$go->insertEvent($eventName,$eventStarttime,$eventEndtime,$peopleNum,$withParner);
            $this->view("alertMsg",$msg);
            header("Refresh:0;/Active/");
        }
    }
    function show(){
        $show=$this -> model("event");
        $result=$show->showevent();
        $this->view("showEvent",$result);
    }
    
    
}
?>