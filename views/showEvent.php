<?php

$ans="<table border='1px'><tr><td>目前報名人數</td><td>活動ID</td><td>建立人id</td><td>建立人姓名</td><td>建立日期</td><td>活動名稱</td><td>報名開始日期</td><td>報名截止日期</td><td>人數限制</td><td>攜伴</td><td>url</td></tr>";
for ($i=0;$i<count($data[0]);$i++){
    //echo $data[1][$i];//及時報名人數
    $ans.="<tr><td>".$data[1][$i]."</td>";//目前報名人數
    
    for($j=0;$j<count($data[0][$i]);$j++){
        if($j==9){
            $ans.="<td><a href='/Active/Signup/actform/".$data[0][$i][9]."'>".$data[0][$i][$j]."</a></td>";
        }elseif($j==8){
             if($data[0][$i][8]){
                $ans.="<td>可</td>";
             }else{
                 $ans.="<td>不可</td>";
             }
        }else{
            $ans.="<td>".$data[0][$i][$j]."</td>";
        }
    }
    $ans.="</tr>";
   
}
$ans.="</table>";

echo $ans;
?>