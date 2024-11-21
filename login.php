<?php
include './config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        // Buscar el usuario en la base de datos
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        // validamos credenciales del usuario en la base de datos
        if ($user && password_verify($password, $user['password'])) {
            echo json_encode(["message" => "Autenticación satisfactoria"]);
        } else {
            echo json_encode(["error" => "Error en la autenticación"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["error" => "Error en la base de datos: " . $e->getMessage()]);
    }
}
?>
