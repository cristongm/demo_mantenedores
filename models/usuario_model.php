<?php
	 // ini_set('display_errors', 'On');
	require('conexion.php');
	//select
	function selectUsuarios(){
		$con = conectar();
		if($con != 'No conectado'){
		$sql = "SELECT 
                    su.id_user, 
                    su.username, 
                    su.email,
                    su.id_group,
                    sg.descripcion AS perfil,
                    su.nombre,
                    su.apellido,
                    su.estado,
                    su.fecha_creacion,
                    su.fecha_modificacion
                FROM sys_user su
                INNER JOIN sys_group sg on su.id_group = sg.id_group";
			if ($row = $con->query($sql)) {
				$return = array();
				while($array = $row->fetch_array(MYSQLI_BOTH)){
					$return[] = $array;
				}
				return $return;
			}
			else{
				return "error";
			}
		}
		else{
			return "error";
		}
	}
    function insertUsuario($usuario){
        
		$con = conectar();
		$con->query("START TRANSACTION");
		if($con != 'No conectado'){
			$sql = "INSERT INTO sys_user
                    (
                        username,
                        password,
                        email,
                        nombre,
                        apellido,
                        id_group,
                        estado,
                        fecha_creacion,
                        fecha_modificacion
                    )
                    VALUES
                    (
                        '" . $usuario["username"] . "',
                        '" . $usuario["password"] . "',
                        '" . $usuario["email"] . "',
                        '" . $usuario["nombre"] . "',
                        '" . $usuario["apellido"] . "',
                        " . $usuario["id_group"] . ",
                        '" . $usuario["estado"] . "',
                        NOW(),
                        NOW()
                    )";
			if ($con->query($sql)) {
				$con->query("COMMIT");
                return "ok";
			}
			else{
				$con->query("ROLLBACK");
				return "error";
			}
		}
		else{
			$con->query("ROLLBACK");
			return "error";
		}
	}
    function updateUsuario($usuario){
		$con = conectar();
		$con->query("START TRANSACTION");
		if($con != 'No conectado'){
            
			$sql = "UPDATE sys_user
                    SET 
                        email = '" . $usuario["email"] . "',
                        nombre = '" . $usuario["nombre"] . "',
                        apellido = '" . $usuario["apellido"] . "',
                        id_group = " . $usuario["id_group"] . ",
                        estado = '" . $usuario["estado"] . "',
                        fecha_modificacion = NOW()";
            if(!is_null($usuario["password"]) && $usuario["password"] != "" && !empty($usuario["password"])){
                $sql .= ", password = '" . $usuario["password"] . "'";
            }
            $sql .= " WHERE id_user = " . $usuario["id_user"];
			if ($con->query($sql)) {
				$con->query("COMMIT");
                return "ok";
			}
			else{
				$con->query("ROLLBACK");
				return "error";
			}
		}
		else{
			$con->query("ROLLBACK");
			return "error";
		}
	}
    function selectDatosByIdUser($id_user){
		$con = conectar();
		if($con != 'No conectado'){
            $sql = "SELECT 
                        id_user, 
                        username, 
                        email, 
                        nombre, 
                        apellido, 
                        id_group, 
                        estado
                    FROM sys_user
                    WHERE id_user = $id_user";
			if ($row = $con->query($sql)) {
				$return = array();
				while($array = $row->fetch_array(MYSQLI_BOTH)){
					$return[] = $array;
				}
				return $return;
			}
			else{
				return "error";
			}
		}
		else{
			return "error";
		}
	}
    function selectDatosUsuarioLogin($username, $password){
		$con = conectar();
		if($con != 'No conectado'){
            $sql = "SELECT 
                        id_user, 
                        username, 
                        email, 
                        nombre, 
                        apellido, 
                        id_group, 
                        estado
                    FROM sys_user
                    WHERE username = '$username'
                    AND password = '$password'";
			if ($row = $con->query($sql)) {
				$return = array();
				while($array = $row->fetch_array(MYSQLI_BOTH)){
					$return[] = $array;
				}
				return $return;
			}
			else{
				return "error";
			}
		}
		else{
			return "error";
		}
	}
    function selectPerfilesSelector(){
        $con = conectar();
		if($con != 'No conectado'){
            $sql = "SELECT 
                        id_group AS value,
                        groupname AS label
                    FROM sys_group
                    WHERE estado = 'Activo'";
			if ($row = $con->query($sql)) {
				$return = array();
				while($array = $row->fetch_array(MYSQLI_BOTH)){
					$return[] = $array;
				}
				return $return;
			}
			else{
				return "error";
			}
		}
		else{
			return "error";
		}
    }
?>