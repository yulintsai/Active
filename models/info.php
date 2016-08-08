<?php
class info{
    
    public function __construct(){
            Server::setConnect();
            Server::pdoConnect();
        }
    
    public function checkAuthority(){
        $sql="SELECT  `eventID` FROM `eventAuthority` WHERE `u_id`='$u_id' ORDER BY `eventID`";
        $ans=Server::$mysqli->query($sql)->fetch_all();
        if($ans){
            return $ans;
        }else{
            return "Error";
        }
        
    }    
    
}
?>