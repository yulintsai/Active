           
<table>
 <tr>
  <td>活動ID</td><td><?php echo $data['eventID']?></td>
 </tr>
  <tr>
  <td>活動名稱</td><td><?php echo $data['name']?></td>
 </tr>
  <tr>
  <td>活動時間</td><td><?php echo $data['eventTime']?></td>
 </tr>
  <tr>
  <td>建立人</td><td><?php echo $data['user_name']?></td>
 </tr>
  <tr>
  <td>員工編號</td><td><?php echo $data[0]?></td>
 </tr>
  <tr>
  <td>員工姓名</td><td><?php echo $data[1]?></td>
 </tr>
</table>
<form method="POST" action="/Active/Signup/act/">
<input type="hidden" name="eventID" value="<?php echo $data['eventID'];?>">
         
            
        
        