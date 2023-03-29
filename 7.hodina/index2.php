<?php
require_once('model.php');

class user_contoroller{
    public function uzivatel1(){
        $model = new user_model("Petra Novotná","petra@gmail.com");
        include("view.php");
    }

    public function uzivatel2(){
        $model = new user_model("Karel Omacka","karel@seznam.cz");
        include("view.php");
    }

}


$contoroller = new user_contoroller();

if (isset($_GET["action"])){
    $action = $_GET["action"];
} else{
    $action ="view";
}

if (method_exists($contoroller, $action)){
    $contoroller->$action();
} else{
    echo "INVALID_ACTION";
}

?>
