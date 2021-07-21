<?php
    require_once("../../models/usuario_model.php");
    if(count($_POST) > 0){
        $id_user = $_POST['id_user'];
        $resultPerfiles = selectPerfilesSelector();
        if($resultPerfiles == 'error'){
            echo "error";
        }else{
            echo json_encode($resultPerfiles);
        }
    }else{
        echo "error";
    }
?>