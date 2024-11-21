<?php
include './config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo json_encode(["error" => "El usuario ya existe"]);
    } else {
        // Hash de la contraseña antes de guardarla
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
            // Insertar el usuario en la base de datos
            $stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
            $stmt->execute([$username, $hashedPassword]);
            
            echo json_encode(["message" => "Usuario registrado con éxito"]);
        } catch (PDOException $e) {
            echo json_encode(["error" => "Error en el registro: " . $e->getMessage()]);
        }
    }
}
?>
