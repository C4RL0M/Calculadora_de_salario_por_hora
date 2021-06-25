<?php
include_once "functions.php";


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "salario_hora";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// valida os dados
$nome = empty($_POST['nome']) ? null : $_POST['nome'];
$matricula = empty($_POST['matricula']) ? null : $_POST['matricula'];
$nascimento = empty($_POST['nascimento']) ? null : $_POST['nascimento'];
$email = empty($_POST['email']) ? null : $_POST['email'];
$valorHora = empty($_POST["salariohora"]) ? null : $_POST['salariohora'];

//// realiza o cadastro /////
$sql = "INSERT INTO colaborador (name, matricula, nascimento, email, salario_hora)
VALUES ('$nome', '$matricula', '$nascimento', '$email', '$valorHora')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
