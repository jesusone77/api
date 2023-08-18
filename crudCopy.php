<?php 

$server = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'prueba';

$conn = new mysqli($server,$user,$pass,$dbname);

if($conn->connect_error) {
    die($conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["create"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $nom_archivo = $_FILES["archivo"]["name"];
    $temp_archivo = $_FILES["archivo"]["tmp_name"];

    $carpeta = "uploads/";

    //moviendo archivo a la carpeta destino.  s

    if (move_uploaded_file($temp_archivo, $carpeta . $nom_archivo)) {
        $sql = "INSERT INTO user (name, email, file) VALUES ('$name','$email','$nom_archivo')";
        if ($conn->query($sql) === TRUE) {  
            echo "Listoooooooo!!!!!!!";
        } else {
            echo "ay noo algo salio mal". $conn->error;
        }
    } else {
        echo "Error archivo";
    }
}  



if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["delete"])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM user where id = '$id'";
    if($conn->query($sql) === TRUE){
        echo "Elimiado correctamente";
    }
}   

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["update"])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM user where id = '$id'";
    if($conn->query($sql) === TRUE){
        echo "Elimiado correctamente";
    }
}   


$sql = "SELECT * FROM user";
$res = $conn->query($sql);

if($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()){
        echo "Id: ".$row['id']." Name: ".$row['name']."email: ".$row['email']." archivo: ".$row['file']."<br>" ;
    }
} else {
    echo "No se encontraron registros";
}

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="crudCopy.php" method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" required><br>
        <label for="email">email</label>
        <input type="email" name="email" required><br>
        <label for="file">archivo</label>
        <input type="file" name="archivo" required><br>
        <input type="submit" name="create">
    </form>
    <div>
        <h3>update</h3>
    <form action="crudCopy.php" method="post" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo ""; ?>"><br>
        <label for="email">email</label>
        <input type="email" name="email" value="<?php echo ""; ?>"><br>
        <label for="file">archivo</label>
        <input type="file" name="archivo" value="<?php echo ""; ?>"><br>
        <input type="submit" name="update">
    </form>
    </div>
    <div>
        <h3>Delete</h3>
    <form action="crudCopy.php" method="post" enctype="multipart/form-data">
        <label for="name">ID:</label>
        <input type="text" name="id"><br>
        <input type="submit" name="delete">
    </form>
    </div>
</body>
</html>
