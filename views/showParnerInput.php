
<table>
<tr><td>攜伴</td><td><select name='parnerNum'>
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
</td>
</tr>
</table>