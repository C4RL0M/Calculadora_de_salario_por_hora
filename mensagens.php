<!--TODO Refatorar o arquivo-->
<?php
include_once "functions.php";

$semMensagensStr = "<h1>Não há mensagens</h1>";
$mensagens = true;
$tabela = "<table>
            <tr>
                <th>Data e hora</th>
                <th>Nome</th>
                <th>nascimento</th>
                <th>matricula</th>
                <th>Email</th>
                <th>salariohora</th>
                <th>Assunto</th>
                <th>Mensagem</th>
            </tr>
            {{dados}}
            </table>";

$msgs = getMessagesArray();
$dados = "";

if (count($msgs)) { //Só gera a tabela se houver mensagens
    for ($i = 0; $i < count($msgs); $i++) {
        $data = $msgs[$i]['data'];
        $nome = $msgs[$i]['nome'];
        $nascimento = $msgs[$i]['nascimento'];
        $matricula = $msgs[$i]['matricula'];
        $mail = $msgs[$i]['email'];
        $salariohora = $msgs[$i]['salariohora'];
        $assunto = $msgs[$i]['assunto'];
        $link = "<a href='mostra-mensagem.php?data=$data&email=$mail'>Ver Mensagem</a>";
        $dados .= "<tr>
</tr>";

    }
    $tabela = str_replace("{{dados}}", $dados, $tabela);
} else {
    $mensagens = false;
}

?>

<!DOCTYPE html>
<html lang=“pt-BR”>
<head>
    <link rel="stylesheet" href="css/style.css"/>
    <meta charset="UTF-8"/>
    <title>Mensagens</title>
    <style>
    a {
        text-decoration: none;
        color: black;
        font-weight: bold;
    }
    </style>
</head>
<body>
<section id="mensagens">
    <?php
    //Aqui é exibida a tabela com os dados, ou uma mensagem informando que não há mensagens
    echo ($mensagens) ? $tabela : $semMensagensStr
    ?>
    <input type="button" onclick="window.open('index.html', '_self')" value="Voltar">
</section>

</body>
</html>