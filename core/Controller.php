<?php

class Controller {
    public function model($model) {
        require_once "../Active/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array()) {
        require_once "../Active/views/$view.php";
    }
    
    public function css($css){
         echo "<link rel='stylesheet' href='/Active/css/".$css.".css'>";
     }
    
    public function js($js){
        echo "<script type='text/javascript' src='/Active/js/".$js.".js'></script> ";
    }
    
}

?>
