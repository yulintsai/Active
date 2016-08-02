
攜伴：<select name="YourLocation">
    <?php 
    $data++;
    for($i=0;$i<$data;$i++){
        if($i==0){
             echo "<option value=''>選擇</option>";
        }else{
    echo "<option value='$i'>$i</option>";
        }
    }
　?>
</select>