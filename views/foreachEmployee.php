

<?php
$datalength=(count($data[0]));
echo "<form action='/Active/Signup/act_authority/$datalength' method='POST'>";
echo "<input type='hidden' name='eventID' value='$data[1]'/>";
// var_dump($data);
$a=0;
echo "<table>";
foreach($data[0] as $k=>$v){
    if(($a%10)==0&&($a>0)){
  echo "<tr></tr>";}
  $a++;
  $empName=$v['account'];
  echo "<td><input type='checkbox' name='$a' value='$empName'>$empName</td>";
    
}
echo "</table>";
?>
<input type="submit" value="Submit"/>
</form>