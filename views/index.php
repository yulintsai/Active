<!DOCTYPE html>
<html>
    <head>
        <title>後台</title>
        <?php 
        $this->js('jquery-3.0.0');
        $this->js('jquery-3.0.0.min');
        $this->js('0731');

        ?>
        <link rel="stylesheet" type="text/css" href="/Active/js/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Active/js/jquery-easyui/themes/icon.css">

    <script type="text/javascript" src="/Active/js/jquery-easyui/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="/Active/js/jquery-easyui/locale/easyui-lang-zh_TW.js"></script>
         <!--<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/themes/hot-sneaks/jquery-ui.css" rel="stylesheet">-->
      <!--<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>-->

        
        
        
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
        <form action="/Active/Event/create" method="post" style="
    position: absolute;
    top: 25%;
    background: antiquewhite;
    border: rgba(127, 90, 59, 0.52) 10px solid;
">
            活動名稱：<input type="text" name="eventName"/><br>
            可報名日期：<input class="dt" type="text" name="eventStarttime"><br>
            報名截止日：<input class="dt" type="text" name="eventEndtime"><br>
    
            
            <!--可報名日期：<input type="datetime-local" name="eventStarttime"><br>-->
            <!--報名截止日：<input type="datetime-local" name="eventEndtime"><br>-->
            人數限制：<input type="number" name="peopleNum"/><br>
            <input type='checkbox' name='withParner' value="1"> 攜伴</p> 
            <input type="submit" name"submit" value="send">
         </form>
         <div id="Event_box"></div>
         <div><button id="logout">Logout</button></div>
         <!--<button id='tst'>123</button>-->
    </body>
</html>