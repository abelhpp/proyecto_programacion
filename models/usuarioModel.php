<?php

// Importar la conexión a la base de datos (db.php)

require_once 'config/db.php';

class UsuarioModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Método para registrar un nuevo usuario en la base de datos

    public function registrarNuevoUsuario($id, $nombre, $apellido, $contrasena, $email, $fecha_registro, $fotocopia_dni, $activado, $roles_id)
    {
        $hashContrasena = password_hash($contrasena, PASSWORD_DEFAULT);

        // Consulta SQL con valores incrustados
        $query = "INSERT INTO usuarios (id, nombre, apellido, contraseña, email, fecha_registro, fotocopia_dni, activado, roles_id) VALUES ('$id', '$nombre', '$apellido', '$hashContrasena', '$email', '$fecha_registro', '$fotocopia_dni', '$activado', '$roles_id')";

        if (!$this->db->execute($query)) {
            echo $this->db->getError();
            throw new Exception("Error al registrar el usuario: " . $this->db->getError());
        }

        return true;
    }

    //Token crear
    public function tokenCreate($id, $token){
        
        // Consulta SQL con valores incrustados
        $query = "UPDATE usuarios SET token='$token' WHERE id=$id;";

        if (!$this->db->execute($query)) {
            echo $this->db->getError();
            throw new Exception("Error al registrar el usuario: " . $this->db->getError());
        }

        return true;
    }


    //Token crear
    public function verificarToken($id, $token){
        
        // Consulta SQL con valores incrustados
        $query = "SELECT token FROM usuarios WHERE id=$id;";

        $tokenDB = $this->db->fetchOne($query);
        
        if ($tokenDB['token'] === $token){
            return false;
        }

        return true;
        
    }




    

    // comprobrar clave
    public function existsEmail($usuario){

        $query = "SELECT contraseña, id, roles_id FROM usuarios where email = '$usuario'";
        $result = $this->db->fetchOne($query);
        if ($result) {
            return $result;    
        }
        echo"sin resultado";
        return false; 
    }

 

    // Método para cambiar la contraseña de un usuario
    public function cambiarContrasenaUsuario($idUsuario, $nuevaContrasena)
    {
        $hashNuevaContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET contrasena = ? WHERE id = ?";


        return $this->db->execute($query);
    }
    // Otros métodos para gestionar usuarios, como actualizar información personal, etc.
}
