<form>
    
<?php
// var_dump($data);
foreach($data as $k=>$v){
    echo "<input type='checkbox' name='withParner' value='1'>".$v['account']."<br>";
}
?>
<input type="submit" value="Submit"/>
</form>