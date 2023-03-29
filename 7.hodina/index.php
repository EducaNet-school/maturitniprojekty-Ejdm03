<?php
require_once("model.php");


class user_controller{

    public function __construct(){
        $model = new user_model("Jan Novák","novak@seznam.cz");
        include ("view.php");
    }
}


new user_controller();


?>
