<?php
class event{
    
    public function __construct(){
            Server::setConnect();
            Server::pdoConnect();
        }
    
    function insertEvent($eventName,$eventTime,$eventStarttime,$eventEndtime,$peopleNum,$withParner){
        
         if($eventStarttime>$eventEndtime){
             return "Set Time Error";
         }else{
            
             $t=time();
             $t.=$a=rand(1,2000);
             $url=md5($t);
             $u_id=$_SESSION['u_id'];
             $user_id=$_SESSION['user_id'];
             $insertTime=date('Y-m-d H:i:s');
             $sql="INSERT INTO `eventsLog`(`insertTime`,`u_id`,`user_name`,`Name`, `eventTime`,`Starttime`, `Endtime`, `peopleNum`,`withParner`,`url`) VALUES ('$insertTime','$u_id','$user_id','$eventName','$eventTime','$eventStarttime','$eventEndtime','$peopleNum','$withParner','$url')";
             if(Server::$mysqli->query($sql)){
                 
                 $sql2="SELECT `eventID` FROM  `eventsLog` WHERE `Name`='$eventName'";
                 if($eventID=Server::$mysqli->query($sql2)){
                    $c_eventID=$eventID->fetch_assoc();
                    $ErrorMsg="Success Create Event\\nPlease Set Authority";
                    $ans=array('msg'=>"$ErrorMsg",'eventID'=>$c_eventID['eventID']);
                    return $ans;
                 }else{
                     return "Error Find eventID";
                 }
                 
             }else{
                 return "Error";
             }
         }
    }
    
    function showevent($eventID){
        $sql="SELECT * FROM  `eventsLog` WHERE `eventID`='$eventID'";
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
    
    // function searchEventNum($url){}
    
    function signup($eventID,$parnerNum){
        $user_id=$_SESSION['user_id'];
        $u_id=$_SESSION['u_id'];
        $check="SELECT `employee` FROM `eventsPeople` WHERE `employee_id`='$u_id'AND`eventID`='$eventID'";
        $ans=Server::$mysqli->query($check)->fetch_row();
        
        $ReadytoSignupNum=$parnerNum+1;
        $count=$this->countSignup($eventID);
        $limit=$this->searchEventlimit($eventID);
        $elseNum=$limit-$count;
        
        
        
        if(($count/$limit)==1||($ReadytoSignupNum>$elseNum)){//判斷是否超出人數
            return "People Full";
        }else{
            if($ans!==null){
             return "You are Joined";
            
            
        }else{
          $sql="INSERT INTO `eventsPeople`(`employee`,`employee_id`,`eventID`,`withPeople`) VALUES ('$user_id','$u_id','$eventID','$parnerNum')";
             if(Server::$mysqli->query($sql)){
                 return "Success Join Events";
             }else{
                 return "Error";
             }
        }
            
        }
    
        
    }
    
    function findAllEventID(){
        $u_id=$_SESSION['u_id'];
        $sql="SELECT  `eventID` FROM `eventAuthority` WHERE `u_id`='$u_id' ORDER BY `eventID`";
        $ans=Server::$mysqli->query($sql)->fetch_all();
        if($ans){
            return $ans;
        }else{
            return "Error";
        }
    }
    
    function countSignup($eventID){
        $sql="SELECT COUNT(`employee`) ,SUM(`withPeople`)  FROM  `eventsPeople` WHERE `eventID` ='$eventID'";
        $ans=Server::$mysqli->query($sql)->fetch_row();
        if($ans){
            return $ans[0]+$ans[1];//員工報名人數+攜伴人數
        }else{
            return "Error";
        }
    }//查報名人數
    
    function searchEventlimit($eventID){
        $sql="SELECT `peopleNum` FROM `eventsLog` WHERE `eventID`='$eventID'";
        $ans=Server::$mysqli->query($sql)->fetch_row();
        if($ans){
            return $ans[0];
        }else{
            return "Error";
        }
    }
    
    function searchAllemployee(){
        $sql="SELECT `account` FROM  `UserData` ";
        $all=Server::$db->query($sql);
        $ans=$all->fetchAll(PDO::FETCH_ASSOC);
        return $ans;
    }
    
    function searchEventDate($url){
        $sql="SELECT `Starttime`,`Endtime` FROM  `eventsLog` WHERE `url`='$url'";
        $ans=Server::$mysqli->query($sql)->fetch_row();
        if($ans){
            return $ans;
        }else{
            return "Error";
        }
    }
    
    
}
?>