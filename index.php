<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form id="register-form">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Registrar</button>
        </form>
        <div id="response-message"></div>
    </div>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form id="login-form">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
        <div id="response-message"></div>
    </div>

    <script>
    document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();  // Evitar el envío del formulario

    // Obtener los valores del formulario
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Enviar la solicitud a la API
    fetch('login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${username}&password=${password}`
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('response-message');
        if (data.message) {
            messageDiv.textContent = data.message;
            messageDiv.style.color = 'green';
        } else if (data.error) {
            messageDiv.textContent = data.error;
            messageDiv.style.color = 'red';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    });
    
    document.getElementById('register-form').addEventListener('submit', function(event) {
    event.preventDefault();  // Evitar el envío del formulario

    // Obtener los valores del formulario
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Enviar la solicitud a la API
    fetch('registro.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `username=${username}&password=${password}`
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('response-message');
        if (data.message) {
            messageDiv.textContent = data.message;
            messageDiv.style.color = 'green';
        } else if (data.error) {
            messageDiv.textContent = data.error;
            messageDiv.style.color = 'red';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

</script>
</body>
</html>
