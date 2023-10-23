<?php

// Importar la conexión a la base de datos (db.php)

require_once 'config/db.php';

class UsuarioModel
{
    private $db;
    private $result;
    private $usuario;
    private $roles_id;
    private $id;
    private $ultimo_acceso;

    



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
            return true;
        }
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
        $this->result = $this->db->fetchOne($query);
        if ($this->result) {
            return true;   
        }
        return false; 
    }
    //Valida password
    public function password_validate($password){
        if (password_verify($password, $this->result["contraseña"])){
            

            
            return true;
        }else{
            return false;
        }
    }
 
    //crear sessiones
    public function create_sessiones($usuario){
        // Iniciar la sesión (si aún no está iniciada)
        session_start();
        $_SESSION['username'] = $usuario;
        $_SESSION['roles_id'] = $this->result["roles_id"];
        $_SESSION['id'] = $this->result["id"];
        $_SESSION['ultimo_acceso'] = time();
        
        $uniqueValue = uniqid();
        // Hashea el valor único para crear el token
        $token = password_hash($uniqueValue, PASSWORD_DEFAULT);
        
        $this->tokenCreate($_SESSION["id"], $token);
    
        $_SESSION["token"] = $token;
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