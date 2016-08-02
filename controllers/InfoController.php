<?php
class InfoController extends Controller {
    
   function nowEvent(){
      $search=$this->model("event");
      $allEventID=$search->findAllEventID();
      $data=array();
       foreach($allEventID as $a=>$b){
          foreach($b as $k=>$eventID){
             $result=$search->countSignup($eventID);
             $limit=$search->searchEventlimit($eventID);
             array_push($data,"$result/$limit<br>");
          }
       }
         //$this->view("showEventInfo",$data);
   }
   
}
?>