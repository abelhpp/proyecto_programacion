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


    // Método para autenticar a un usuario por correo y contraseña
    public function autenticarUsuario($correo, $contrasena){
        $query = "SELECT * FROM usuarios WHERE correo = ?";
        $params = array($correo);

        $usuario = $this->db->fetchOne($query);

        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return $usuario;
        } else {
            return false;
        }
    }

    // comprobrar clave
    public function buscarPassword($idUsuario, $Contrasena){
        $passHash = password_hash($Contrasena, PASSWORD_DEFAULT);

        $query = "SELECT  usuarios SET contrasena = ? WHERE id = ?";
        $params = array($hashNuevaContrasena, $idUsuario);

        return $this->db->execute($query);
    }


    // Método para cambiar la contraseña de un usuario
    public function cambiarContrasenaUsuario($idUsuario, $nuevaContrasena)
    {
        $hashNuevaContrasena = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET contrasena = ? WHERE id = ?";
        $params = array($hashNuevaContrasena, $idUsuario);

        return $this->db->execute($query);
    }
    // Otros métodos para gestionar usuarios, como actualizar información personal, etc.
}
