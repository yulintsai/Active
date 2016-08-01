 
 <?php
        echo "活動ID:$data[2]<br>活動名稱：$data[1]<br>建立人：$data[0]<br>";
       
        ?>
 <form method="post" action="/Active/Signup/act/">
             <input type="hidden" name="eventID" value="<?php echo $data[2];?>">
            員工編號：<?php echo $data[4]?><br>
            員工姓名：<?php echo $data[5]?><br>
            
         
            <input type="submit" value="參加"/>
        </form>
        