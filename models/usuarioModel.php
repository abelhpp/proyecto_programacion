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

    public function registrarNuevoUsuario( $email, $name, $apellido, $dni, $password, $imagenBinaria)
    {
        
        //Activado 0   roles 1    token 0
        $activado = 0; $roles_id = 1; $token = '0';
        
        $fecha_registro = date("Y-m-d");

        $hashPass = password_hash($password, PASSWORD_DEFAULT);

        // Consulta SQL con valores incrustados
        $query = "INSERT INTO usuarios (nombre, apellido, email, contraseña, fecha_registro, fotocopia_dni, dni, activado, roles_id, token) 
        VALUES('$name', '$apellido', '$email', '$hashPass', '$fecha_registro', '$imagenBinaria', $dni, $activado, $roles_id, '$token')";
        
        $insert = $this->db->execute($query);
        if (!$insert) {
            echo "Error en enviar Modelo";
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


    //Verificar email en la db
    public function verificaEmail($email){
        // Consulta SQL para verificar si el email existe en la tabla usuarios
        $query = "SELECT email FROM usuarios WHERE email = '$email';";
        $result = $this->db->execute($query);
    
        // Verificar si se encontró un registro
        if ($result->num_rows > 0) {
            // Se encontró un registro con el email especificado, entonces retorna true
            return true;
        }
        // No se encontró ningún registro con el email especificado, retorna false
        return false;
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

        $query = "SELECT contraseña, id, roles_id FROM usuarios where email = '$usuario' AND activado = 1";
        $result = $this->db->fetchOne($query);
        if ($result) {
            return $result;    
        }
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