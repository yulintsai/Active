<!DOCTYPE html>
<html>
    <head>
        <title>前台</title>
         <?php 
            $this->css('main');
            $this->css('event');
            $this->js('jquery-3.0.0');
            $this->js('0731');
        ?>
    </head>
    <body>
        <h1>前台</h1>
        <div id="Event_box"></div>
        <div><button id="logout">Logout</button></div>
        <a href="/Active/Login/gotoW/b"><button>前台</button></a>
        <a href="/Active/Login/gotoW/a"><button>後台</button></a>
    </body>
</html>