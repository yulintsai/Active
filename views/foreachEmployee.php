

<?php
echo "<form action='/Active/Signup/act_authority/' method='POST'>";
echo "<input type='hidden' name='eventID' value='$data[1]'/>";
$a=0;
echo "<table>";
foreach($data[0] as $k=>$v){
    if(($a%10)==0&&($a>0)){
      echo "<tr></tr>";}
      $a++;
      $empID=$v['u_id'];//員工編號
      $empName=$v['account'];//員工姓名
      echo "<td><input type='checkbox' checked='true' name='eventAuthority[]' value='$empID'>$empName</td>";
}
echo "</table>";
?>
<input type="submit" value="Submit"/>
</form>