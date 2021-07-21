<?php
    require_once("../../models/usuario_model.php");
    header('Access-Control-Allow-Origin: *');
    header('Content-type: application/json');
    $result = array(
        "result" => true,
        "msg" => "",
        "datosUsuario" => []
    );
    
    if(count($_POST) > 0){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $resultUser = selectDatosUsuarioLogin($username, $password);
        if($resultUser == 'error' || count($resultUser) == 0){
            $result["result"] = false;
            $result["msg"] = "Usuario no encontrado";
        }else{
            $result["datosUsuario"] = $resultUser;
        }
        echo json_encode($result);
    }else{
        $result["result"] = false;
        $result["msg"] = "Sin permisos";
        echo json_encode($result);
    }
?>