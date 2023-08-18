<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Operación CREATE (Crear)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];

    $sql = "INSERT INTO user (name, email) VALUES ('$name', '$email')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro creado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Operación READ (Leer)
$sql = "SELECT * FROM user";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"] . " - name: " . $fila["name"] . " - Email: " . $fila["email"] . "<br>";
    }
} else {
    echo "No se encontraron registros.";
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD en PHP</title>
</head>
<body>
    <h2>Crear Usuario</h2>
    <form method="POST" action="crudSencillo.php">
        <label>name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <button type="submit" name="create">Crear</button>
    </form>
</body>
</html>
