<?php
class event{
    
    public function __construct(){
            Server::setConnect();
        }
    
    function insertEvent($eventName,$eventStarttime,$eventEndtime,$peopleNum,$withParner){
         $t=time();
         $t.=$a=rand(1,2000);
         $url=md5($t);
         $u_id=$_SESSION['u_id'];
         $user_id=$_SESSION['user_id'];
         $insertTime=date('Y-m-d H:i:s');
         $sql="INSERT INTO `eventsLog`(`insertTime`,`u_id`,`user_name`,`Name`, `Starttime`, `Endtime`, `peopleNum`,`withParner`,`url`) VALUES ('$insertTime','$u_id','$user_id','$eventName','$eventStarttime','$eventEndtime','$peopleNum','$withParner','$url')";
         if(Server::$mysqli->query($sql)){
             return "Success Create Events";
         }else{
             return "Error";
         }
    }
    
    function showevent(){
        $sql="SELECT * FROM  `eventsLog` ";
        $result=Server::$mysqli->query($sql)->fetch_all();
        return $result;
    }
    
    function findUrl(){
        $sql="SELECT `url` FROM  `eventsLog`";
        $result=Server::$mysqli->query($sql)->fetch_all();
        return $result;
        
    }//找該活動參加的URL
    
    function findEventInfo($url){
         $sql="SELECT `name`,`user_name`,`eventID`,`withParner` FROM  `eventsLog` WHERE `url`='$url'";
         $result=Server::$mysqli->query($sql)->fetch_row();
         array_push($result,$_SESSION['u_id'],$_SESSION['user_id']);
         return $result;
    }
    
    function searchEventNum($url){}
    
    function signup($eventID){
        $user_id=$_SESSION['user_id'];
        $u_id=$_SESSION['u_id'];
        $check="SELECT `employee` FROM `eventsPeople` WHERE `employee_id`='$u_id'AND`eventID`='$eventID'";
        $ans=Server::$mysqli->query($check)->fetch_row();
        if($ans!==null){
             return "You are Joined";
            
            
        }else{
          $sql="INSERT INTO `eventsPeople`(`employee`,`employee_id`,`eventID`) VALUES ('$user_id','$u_id','$eventID')";
             if(Server::$mysqli->query($sql)){
                 return "Success Join Events";
             }else{
                 return "Error";
             }
        }
    }
    
    function countSignup(){
        $sql="SELECT * FROM  `eventsPeople` WHERE eventID =3";
    }//查報名人數
    
}
?>