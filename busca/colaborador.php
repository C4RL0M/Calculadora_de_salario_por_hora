<?php
$colaborador_encontrado = false;
$valor_final = false;

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

$email = empty($_POST['email']) ? null : $_POST['email'];
$ano = empty($_POST['ano']) ? null : $_POST['ano'];
$mes = empty($_POST['mes']) ? null : $_POST['mes'];
$horas_trabalhadas = empty($_POST['horas_trabalhadas']) ? null : $_POST['horas_trabalhadas'];


if($email != null && $ano == null){
    // valida os dados

    //// realiza o cadastro /////
    $sql = "SELECT * FROM salario_hora.colaborador WHERE email = '$email';";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $colaborador_encontrado = $row["email"];
            $email = $row["email"];
        }
    } else {
        echo "0 results 1";
    }

    $conn->close();
} elseif ($ano != null && $mes != null) {
    //// realiza o cadastro /////
    $sql = "SELECT * FROM salario_hora.colaborador WHERE email = '$email';";
    $result = $conn->query($sql);
    $id_colaborador = null;

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $colaborador_encontrado = $row["email"];
            $id_colaborador = $row["id"];
            $valor_hora = $row["salario_hora"];
            $valor_final = $row["salario_hora"]*$horas_trabalhadas;
        }
    } else {
        echo "0 results 2";
    }

    //// realiza o cadastro da folha /////
    $sql = "INSERT INTO folha (colaborador_id, ano, mes, horas_trabalhadas)
    VALUES ('$id_colaborador', '$ano', '$mes', '$horas_trabalhadas')";

    if ($conn->query($sql) === TRUE) {

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>CARLOS NOWATZKI</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

<!-- Header -->
<header id="header">
    <h1>Pesquisa do Colaborador!</h1>
</header>

<!-- Signup Form -->
<form action="colaborador.php" method="post">

    <?php
    if($colaborador_encontrado == false) {
        echo
        '
         <p>Olá!<br />
        Digite o e-mail do colaborador para a pesquisa de dados:<a href="#">)</a></p>
        <div>
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" required/>
        </div>
        <br>
    <br>
    </div>
    <div>
        <button type="submit"  id="botao" >Pesquisar</button>
    </div>
        ';

    } elseif($ano != null){
        echo
        '<div>
            <h1>Salário a pagar: '.($valor_final).'</h1>
        </div>';
    }
    else {
        echo
        '<div>
            <label for="email">E-mail:</label>
            <input type="text" id="email" name="email" value="'.$colaborador_encontrado.'"/>
        </div>
        <br/>
        <div>
            <label for="horas_trabalhadas">Horas trabalhadas:</label>
            <input type="text" id="horas_trabalhadas" name="horas_trabalhadas"/>
        </div>
        <br/>
       <div>
            <label for="ano">Ano:</label>
            <input type="text" id="ano" name="ano"/>
        </div>
        <br/>
        <label for="mes">Mês:</label>
       <select name="mes">
                     <option value="Janeiro">Janeiro </option>
                     <option value="Fevereiro">Fevereiro </option>
                      <option value="Mar&ccedil;o">Mar&ccedil;o </option>
                      <option value="Abril">Abril </option>
                       <option value="Maio">Maio </option>
                      <option value="Junho">Junho </option>
                     <option value="Julho">Julho </option>
                     <option value="Agosto">Agosto </option>
                     <option value="Setembro">Setembro </option>
                     <option value="Outubro">Outubro </option>
                     <option value="Novembro">Novembro </option>
                     <option value="Dezembro">Dezembro </option>
        </select>
        <br>
    <br>
    </div>
    <div>
        <button type="submit"  id="botao" >Pesquisar</button>
    </div>
        ';
    }
    ?>


</form>

<!-- Footer -->


<!-- Scripts -->
<script src="assets/js/main.js"></script>

</body>
</html>


