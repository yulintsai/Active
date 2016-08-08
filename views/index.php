<!DOCTYPE html>
<html>

<head>
    <title>後台</title>
    <?php 
        $this->css('main');
        $this->css('event');
        $this->js('jquery-3.0.0');
        $this->js('jquery-3.0.0.min');
        $this->js('0731');
        $this->js('jquery-easyui/jquery.easyui.min');
        $this->js('jquery-easyui/locale/easyui-lang-zh_TW');
        ?>
    <link rel="stylesheet" type="text/css" href="/Active/js/jquery-easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/Active/js/jquery-easyui/themes/icon.css">
</head>

<body>
    <h1>後台</h1>
    <form id="createForm" action="/Active/Event/create" method="post">
        活動名稱：<input type="text" name="eventName" /><br> 
        活動日期：<input class="dt"  min="2016-08-04 00:00:00"name="eventTime"><br> 
        報名日期：<input class="dt"  name="eventStarttime"><br> 
        截止日期：<input class="dt"  name="eventEndtime"><br>
        人數限制：<input type="number" name="peopleNum" /><br>
        <input type='checkbox' name='withParner' value="1"> 攜伴</p>
        <input type="submit" name "submit" value="send">
    </form>
    <div id="Event_box"></div>
    <div><button id="logout">Logout</button></div>
    <a href="/Active/Login/gotoW/b"><button>前台</button></a>
    <a href="/Active/Login/gotoW/a"><button>後台</button></a>
</body>

</html>