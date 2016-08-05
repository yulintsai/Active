<?php
class authority{
    
    public function __construct(){
            Server::setConnect();
            Server::pdoConnect();
        }
    
    function setAuthority($emp_id,$eventID){
        $sql="INSERT INTO `eventAuthority`(`u_id`, `eventID`) VALUES ('$emp_id','$eventID')";
        $ans=Server::$mysqli->query($sql);
        return $ans;
    }
    
}
?>