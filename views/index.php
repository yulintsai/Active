<!DOCTYPE html>
<html>
    <head>
        <?php 
        $this->js('jquery-3.0.0');
        $this->js('jquery-3.0.0.min');
        $this->js('0731');
        
        ?>
        <style type="text/css">
            #Event_box{
            position: absolute;
            top:25%;
            left: 34%;
        }
        </style>
    </head>
    <body>
        <h1>後台</h1>
        <form action="/Active/Event/create" method="post">
            活動名稱：<input type="text" name="eventName"/><br>
            可報名日期：<input type="datetime-local" name="eventStarttime"><br>
            報名截止日：<input type="datetime-local" name="eventEndtime"><br>
            人數限制：<input type="number" name="peopleNum"/><br>
            <input type='checkbox' name='withParner' value="1"> 攜伴</p> 
            <input type="submit" name"submit" value="send">
         </form>
         <div id="Event_box"></div>
         <div><button id="logout">Logout</button></div>
         <!--<button id='tst'>123</button>-->
    </body>
</html>