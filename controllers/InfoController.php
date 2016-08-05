<?php
class InfoController extends Controller {
    
   function nowEvent(){
        $search=$this->model("event");
        $Info=$search->eventInfo();
        //var_dump($Info);
        echo "<table>";
        foreach ($Info as $row) {
            echo "<tr>";
            foreach($row as $value){
            echo "<td>".$value."</td>";
            }
             echo "</tr>";
        }
        echo "</table>";
        // $this->view("showForeach",$Info);
   }
   
}
?>