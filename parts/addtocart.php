<?php

//Ligação à base de dados
$servername = "localhost";
$username = "root";
$password = "";
$bd = "Projeto_Si";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
    //Caso haja ligação executa o código abaixo!vv
}


//Verifica se todos os campos do formulário foram preenchidos e não estão vazios
if ((isset($_POST['vinyl_quantity']) && !empty($_POST['vinyl_quantity']))) {
    $albumQtt = $_POST['vinyl_quantity'];
    $albumId = $_GET['id'];

    //inserção dos dados na tabela mensagens
    $sql = "INSERT INTO inventory (albums_id, quantity) VALUES(
        '" . mysqli_real_escape_string($conn, $albumId) . "',
        '" . mysqli_real_escape_string($conn, $albumQtt) . "')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        mysqli_query($conn, "INSERT INTO message_read (messages_id , clients_id) VALUES(
                    '" . mysqli_real_escape_string($conn, $last_id) . "',
                    '" . mysqli_real_escape_string($conn, $linha['id']) . "')") or die("Error 1: " . mysqli_error($conn));

    }
} else {
    print "Ups, something went wrong";
}


?>