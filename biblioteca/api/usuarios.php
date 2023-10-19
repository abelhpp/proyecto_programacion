<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$request_method = $_SERVER["REQUEST_METHOD"];

switch ($request_method) {
    case 'GET':
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        $usuarios = array();
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        echo json_encode($usuarios);
        break;
    case 'POST':
        date_default_timezone_set('America/Argentina/Buenos_Aires');
        $fecha_registro = date('Y-m-d');

        $data = json_decode(file_get_contents("php://input"), true);
        
        $dni = $data['dni'];
        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $email = $data['email'];
        $pass = $data['pass'];
        $fecha_registro = $data['fecha_registro'];
        $fotocopia_dni = $data['fotocopia_dni'];
        $activado = $data['activado'];
        $token = $data['token'];
        $roles_id = $data['roles_id'];
        
        $sql = "INSERT INTO usuarios (dni, nombre, apellido, email, pass, fecha_registro, fotocopia_dni, activado, token, roles_id) 
        VALUES ('$dni', '$nombre', '$apellido', '$email', '$pass', '$fecha_registro', '$fotocopia_dni', '$activado', '$token', '$roles_id')";
       
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Usuario creado correctamente"));
        } else {
            echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
        }
        break;
        case 'PUT':
            // Obtener datos del cuerpo de la solicitud
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $data['id'];
            $dni = $data['dni'];
            $nombre = $data['nombre'];
            $apellido = $data['apellido'];
            $email = $data['email'];
            $activado = $data['activado'];
    
            // Consulta SQL para actualizar el usuario
            $sql = "UPDATE usuarios SET dni='$dni', nombre='$nombre', apellido='$apellido', email='$email', activado='$activado' WHERE id=$id";
    
            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("message" => "Usuario actualizado correctamente"));
            } else {
                echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
            }
            break;
                
    case 'DELETE':
        $id = $_GET['id'];
        $sql = "DELETE FROM usuarios WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Usuario eliminado correctamente"));
        } else {
            echo json_encode(array("message" => "Error: " . $sql . "<br>" . $conn->error));
        }
        break;
    default:
        http_response_code(405);
        echo json_encode(array("message" => "Método no permitido"));
        break;
}

$conn->close();
?>
