<?php
    require_once("../../models/usuario_model.php");
    if(count($_POST) > 0){
        $id_user = $_POST['id_user'];
        $resultUser = selectDatosByIdUser($id_user);
        $resultPerfiles = selectPerfilesSelector();
        if($resultUser == 'error' || $resultPerfiles == 'error'){
            echo "error";
        }else{
            $result = array(
                'datosUsuario' => $resultUser,
                'selectorPerfiles' => $resultPerfiles
            );
            echo json_encode($result);
        }
    }else{
        echo "error";
    }
?>