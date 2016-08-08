<?php
class event{
    
    public function __construct(){
            Server::setConnect();
            Server::pdoConnect();
            Server::pdo2Connect();
        }
    
    public function insertEvent($eventName,$eventTime,$eventStarttime,$eventEndtime,$peopleNum,$withParner){
        
         if($eventStarttime>$eventEndtime){
             return "Set Time Error";
         }else{
             $u_id=$_SESSION['u_id'];
             $user_id=$_SESSION['user_id'];
             $t=time();
             $t.=$a=rand(1,2000);
             $url=md5($user_id.$t);
             
             $insertTime=date('Y-m-d H:i:s');
             $sql="INSERT INTO `eventsLog`(`insertTime`,`u_id`,`user_name`,`Name`, `eventTime`,`Starttime`, `Endtime`, `peopleNum`,`withParner`,`url`) VALUES ('$insertTime','$u_id','$user_id','$eventName','$eventTime','$eventStarttime','$eventEndtime','$peopleNum','$withParner','$url')";
             $Infosql="INSERT INTO `eventInfo`(`peopleLimit`) VALUES ('$peopleNum')";
             if(Server::$mysqli->query($sql)){
                Server::$mysqli->query($Infosql);
                 $sql2="SELECT `eventID` FROM  `eventsLog` WHERE `Name`='$eventName'";
                 if($eventID=Server::$mysqli->query($sql2)){
                    $c_eventID=$eventID->fetch_assoc();
                    $ErrorMsg="Success Create Event\\nPlease Set Authority";
                    $ans=array('msg'=>"$ErrorMsg",'eventID'=>$c_eventID['eventID']);
                    $_SESSION['eventID']=$c_eventID['eventID'];
                    return $ans;
                 }else{
                     return "Error Find eventID";
                 }
                 
             }else{
                 return "Error";
             }
         }
    }
    //產生活動
    
    public function showevent($eventID){
        $sql="SELECT * FROM  `eventsLog` WHERE `eventID`='$eventID'";
        $result=Server::$mysqli->query($sql)->fetch_all();
        return $result;
    }
    //列出該活動資訊
    
    public function findUrl(){
        $sql="SELECT `url` FROM  `eventsLog`";
        $result=Server::$mysqli->query($sql)->fetch_all();
        return $result;
        
    }
    //找該活動參加的URL
    
    public function findEventInfo($url){
         $sql="SELECT `name`,`user_name`,`eventID`,`withParner`,`eventTime` FROM  `eventsLog` WHERE `url`='$url'";
         $result=Server::$mysqli->query($sql)->fetch_assoc();
         array_push($result,$_SESSION['u_id'],$_SESSION['user_id']);
         return $result;
    }
    //找出報名資訊
    
    public function signup($eventID,$parnerNum){/*ADD報名資格判斷*/
        $user_id=$_SESSION['user_id'];
        $u_id=$_SESSION['u_id'];
        $check="SELECT `employee` FROM `eventsPeople` WHERE `employee_id`='$u_id'AND`eventID`='$eventID'";
        $ck_join=Server::$db2->query($check)->fetch();
        $ReadytoSignupNum=$parnerNum+1;
        
        Server::$db2->beginTransaction();
        
        $cksql="SELECT `peopleSum`, `peopleLimit` FROM `eventInfo` WHERE `eventID`='$eventID' FOR UPDATE";
        $ans=Server::$db2->query($cksql)->fetch(PDO::FETCH_ASSOC);
        
        $limit=$ans['peopleLimit'];
        $elseNum=$limit-$ans['peopleSum'];

        if($elseNum<=0||($ReadytoSignupNum>$elseNum)){//判斷一起報名人數是否會超出限制人數
            return "People Full";
        }else{
            sleep(10);
            if($ck_join){   //確認是否報名過
             return "You are Joined";
            }else{          //可以進行報名
              $sql="INSERT INTO `eventsPeople`(`employee`,`employee_id`,`eventID`,`withPeople`) VALUES (:user_id,:u_id,:eventID,:parnerNum)";
              $ans=Server::$db2->prepare($sql);
              $ans->bindParam(':user_id',$user_id);
              $ans->bindParam(':u_id',$u_id);
              $ans->bindParam(':eventID',$eventID);
              $ans->bindParam(':parnerNum',$parnerNum);
              $res = $ans->execute();
              $peopleSum=$parnerNum+1;
              $Infosql="UPDATE `eventInfo` SET `peopleSum`=`peopleSum` + :peopleSum WHERE `eventID` = :eventID";
              $ans=Server::$db2->prepare($Infosql);
              $ans->bindParam(':peopleSum',$peopleSum, PDO::PARAM_INT);
              $ans->bindParam(':eventID',$eventID);
              $ans->execute();
                
                if($res){
                     Server::$db2->commit();
                    return "Success Join Events";
                 }else{
                     return "Error";
                 }
            }
        }
    
        
    }
    //參加活動
    
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
    //找出所有該名員工可參加的活動ID
    
    function countSignup($eventID){
        $sql="SELECT COUNT(`employee`) ,SUM(`withPeople`)  FROM  `eventsPeople` WHERE `eventID` ='$eventID'";
        $ans=Server::$mysqli->query($sql)->fetch_row();
        if($ans){
            return $ans[0]+$ans[1];//員工報名人數+攜伴人數
        }else{
            return "Error";
        }
    }
    //查報名人數
    
    function searchEventlimit($eventID){
        $sql="SELECT `peopleNum` FROM `eventsLog` WHERE `eventID`='$eventID'";
        $a=Server::$mysqli->query($sql);
        $ans=$a->fetch_row();
        // return $ans;
        if($ans){
            return $ans[0];
        }else{
            return "Error";
        }
    }
    //查該活動限制人數
    
    function searchAllemployee(){
        $sql="SELECT `u_id`,`account` FROM  `UserData` ";
        $all=Server::$db->query($sql);
        $ans=$all->fetchAll(PDO::FETCH_ASSOC);
        return $ans;
    }
    //列出所有員工名單
    
    function searchEventDate($url){
        $sql="SELECT `Starttime`,`Endtime` FROM  `eventsLog` WHERE `url`='$url'";
        $ans=Server::$mysqli->query($sql)->fetch_row();
        if($ans){
            return $ans;
        }else{
            return "Error";
        }
    }
    //尋找該活動的報名與截止時間
    
    function eventInfo(){
        $sql="SELECT * FROM  `eventsLog`";
        $ans=Server::$mysqli->query($sql)->fetch_all();
        if($ans){
            return $ans;
        }else{
            return "Error";
        }
    }
    //列出所有活動資訊
    
    
}
?>