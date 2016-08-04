<?php
$ans="<table id='eventinfo'><tr><td>目前報名人數</td><td>活動ID</td><td>建立人id</td><td>建立人姓名</td><td>建立日期</td><td>活動名稱</td><td>活動日期</td><td>報名開始日期</td><td>報名截止日期</td><td>人數限制</td><td>攜伴</td><td>報名網址</td></tr>";
for ($i=0;$i<count($data[0]);$i++){
    //echo $data[1][$i];//及時報名人數
    ($i%2)?$color="rgba(255, 152, 0, 0.5)":$color="rgba(0, 137, 255, 0.33)";
    $ans.="<tr style='background:$color'><td>".$data[1][$i]."</td>";//目前報名人數
    
    for($j=0;$j<count($data[0][$i]);$j++){
        for($k=0;$k<count($data[0][$i][$j]);$k++){
            if($k==10){
            $ans.="<td><a href='/Active/Signup/actform/".$data[0][$i][$j][$k]."'>".$data[0][$i][$j][$k]."</a></td>";
        }elseif($k==9){
             if($data[0][$i][$j][$k]){
                $ans.="<td>可</td>";
             }else{
                 $ans.="<td>不可</td>";
             }
        }else{
            $ans.="<td>".$data[0][$i][$j][$k]."</td>";
        }
            
        }
    
        
    }
    $ans.="</tr>";
   
}
$ans.="</table>";

echo $ans;


?>