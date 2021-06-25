<?php
$MENSAGENS = "messages/contatos.json";

date_default_timezone_set("America/Sao_Paulo");

function readFileContent($fileName) {
    $file = fopen($fileName, "r");
    $content = fread($file, filesize($fileName));
    fclose($file);
    return $content;
}

function getMessagesArray()
{
    global $MENSAGENS;

    $content = readFileContent($MENSAGENS);
    $json = json_decode($content, true);
    return $json['mensagens'];
}

function saveMessage($obj) {
    global $MENSAGENS;

    //Salva a mensagem enviada pela text area
    $mensagem = $obj['mensagem'];
    unset($obj['mensagem']);
    $fileName = sprintf("messages/%s%s.json", parseDate($obj['data']), $obj['email']);
    $file = fopen($fileName, "w");
    fwrite($file, $mensagem);
    fflush($file);
    fclose($file);

    //Salva os dados de quem enviou a mensagem
    $msgsArr = getMessagesArray();
    $msgsArr[] = $obj;
    $json['mensagens'] = $msgsArr;
    $file = fopen($MENSAGENS, "w");
    fwrite($file, json_encode($json));
    fflush($file);
    fclose($file);

}

function parseDate($date) {
    $date = str_replace(" ", "", $date);
    $date = str_replace("/", "", $date);
    $date = str_replace("-", "", $date);
    $date = str_replace(":", "", $date);
    return $date;
}

