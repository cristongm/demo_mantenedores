<?php
    require_once("../../models/usuario_model.php");
    if(count($_POST) > 0){
        $result = selectUsuarios();
        if($result == 'error'){
            echo "error";
        }else{
            echo json_encode($result);
        }
    }else{
        echo "error";
    }
?>