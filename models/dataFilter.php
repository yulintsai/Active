<?php
    class dataFilter{
        public function __construct(){
            Server::setConnect();
        }
        
        public function test_input($data = Array()) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          $data = Server::$mysqli->real_escape_string($data);
          return $data;
        } //過濾Input
         public function checkDatetime($date_time){
            $check = false;
            if (strtotime($date_time)){
            //不管檢查時間或日期格式，都只取第一個陣列值
                list($first) = explode(" ", $date_time);
                //如果包含「:」符號，表示只檢查時間
                if (strpos($first, ":")){
                    //strtotime函數已經檢查過，直接給true
                    $check = true;
                }else{
                    //將日期分年、月、日，區隔符用「-/」都適用
                    list($y, $m, $d) = preg_split("/[-\/]/", $first);
                    //檢查是否為4碼的西元年及日期邏輯(潤年、潤月、潤日）
                    if (substr($date_time, 0, 4)==$y && checkdate($m, $d, $y)){
                        $check = true;
                    }
                }
            }
         return $check;
        }
        
        
    }
?>