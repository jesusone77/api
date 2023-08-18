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
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];

    // Manejo de la carga de archivos
    $archivoNombre = $_FILES["archivo"]["name"];
    $archivoTemp = $_FILES["archivo"]["tmp_name"];
    $carpetaDestino = "uploads/"; // Asegúrate de tener una carpeta llamada "uploads" en el mismo directorio

    // Mueve el archivo cargado a la carpeta de destino
    if (move_uploaded_file($archivoTemp, $carpetaDestino . $archivoNombre)) {
        $sql = "INSERT INTO user (name, email, file) VALUES ('$nombre', '$email', '$archivoNombre')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro creado exitosamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error al cargar el archivo.";
    }
}

// Operación READ (Leer)
$sql = "SELECT * FROM user";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        echo "ID: " . $fila["id"] . " - name: " . $fila["name"] . " - Email: " . $fila["email"] . "file: ". $fila['file'] ."<br>";
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
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Archivo:</label>
        <input type="file" name="archivo"><br>
        <button type="submit" name="create">Crear</button>
    </form>
</body>
</html>