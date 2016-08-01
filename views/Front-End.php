<!DOCTYPE html>
<html>
    <head>
         <?php 
        $this->js('jquery-3.0.0');
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
        <h1>前台</h1>
        <div id="Event_box"></div>
        <div><button id="logout">Logout</button></div>
    </body>
</html>