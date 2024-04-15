<?php
// Establecer la conexión con la base de datos
$server = "localhost";
$username = "root";
$pass = "";
$db = "votacion";

$conn = new mysqli($server, $username, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$respuesta = '';

// Obtener informacion
$nombre = $_POST['nombre'];
$alias = $_POST['alias'];
$rut = $_POST['rut'];
$email = $_POST['email'];
$region = $_POST['region'];
$comuna = $_POST['comuna'];
$candidato = $_POST['candidato'];


// Si la variable trae como valor  'true' entonces se guardara en la bbdd con un 1 de lo contrario se guardará con un 0

$web = ($_POST['web'] == 'true') ? 1 : 0; 
$tv = ($_POST['tv'] == 'true') ? 1 : 0;
$rrss = ($_POST['rrss'] == 'true') ? 1 : 0;
$amigo = ($_POST['amigo'] == 'true') ? 1 : 0;



// Consulta SQL para verificar si el RUT ya existe
$sql = "SELECT * FROM voto WHERE rut = '$rut'";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    $respuesta = 0;
} else {
    $respuesta = 1;
    // Preparar la consulta SQL para insertar el voto en la base de datos
    $sql2 = "INSERT INTO `voto` (`id`, `nombre`, `alias`, `rut`, `email`, `region`, `comuna`, `candidato`, `web`, `tv`,`rrss`,`amigo`) VALUES (
        'null',
        '$nombre', 
        '$alias',
        '$rut',
        '$email',
        '$region',
        '$comuna',
        '$candidato',
        '$web',
        '$tv',
        '$rrss',
        '$amigo'
        )";

    $conn->query($sql2);
     
}

echo $respuesta;

$conn->close();

?>
