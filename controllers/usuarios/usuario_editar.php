<?php
    require_once("../../models/usuario_model.php");
    $result = array(
        "result" => true,
        "msg" => ""
    );
    if(count($_POST) > 0){
        $result = validarCamposVacios();
        if($result["result"]){
            $usuario = array(
                "id_user" => $_POST["id_user"],
                "password" => $_POST["password"],
                "nombre" => $_POST["nombre"],
                "apellido" => $_POST["apellido"],
                "email" => $_POST["email"],
                "id_group" => $_POST["id_group"],
                "estado" => $_POST["estado"]
            );
            $updateResult = updateUsuario($usuario);
            if($updateResult == "ok"){
                $result["msg"] = "Usuario editado correctamente";
            }else{
                $result["result"] = false;
                $result["msg"] = "Ha ocurrido un error al editar el usuario";
            }
            echo json_encode($result);
        }else{
            echo json_encode($result);
        }
    }else{
        $result["result"] = false;
        $result["msg"] = "Sin permisos";
        echo json_encode($result);
    }
    function validarCamposVacios(){
        $result = array(
            "result" => true,
            "msg" => ""
        );
        if( !isset($_POST['email']) || is_null($_POST['email']) || $_POST['email'] == "" || empty($_POST['email']) ||
            !isset($_POST['id_group']) || is_null($_POST['id_group']) || $_POST['id_group'] == "" || empty($_POST['id_group'])){
            $result["result"] = false;
            $result["msg"] = "Faltan campos por completar";
        }
        return $result;
    }
?>