<?php
// echo var_dump($data);
$ans="<table border='1px'><tr><td>活動ID</td><td>建立人id</td><td>建立人姓名</td><td>建立日期</td><td>活動名稱</td><td>報名開始日期</td><td>報名截止日期</td><td>人數限制</td><td>攜伴</td><td>url</td></tr>";
foreach($data as $k=>$v){
       // var_dump($v);
$ans.="<tr>";
        foreach($v as $a=>$b){
            
            if($a=='9'){//$a==url
            $ans.= "<td><a href='/Active/Signup/actform/$b'>".($b)."</a></td>";
            
                
            }else{
            $ans.= "<td>".($b)."</td>";
            }
        }
        $ans.="</tr>";
}
$ans.="</table>";
echo $ans;
?>