<?php

session_start();

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

    $getPrice = mysqli_query($conn, "select price from albums where id='$albumId'");
    $linhaPrice = mysqli_fetch_assoc($getPrice);

    $albumPrice = $linhaPrice['price']*$albumQtt;

    $getId = mysqli_query($conn, "select id from compra where clients_id='".$_SESSION['user_id']."' AND finalizado='0'");
    $linhaId = mysqli_fetch_assoc($getId);

    $basketId = $linhaId['id'];

    //inserção dos dados na tabela mensagens
    $sql = "INSERT INTO produtos (albums_id, album_total, compra_id, qtd) VALUES(
        '" . mysqli_real_escape_string($conn, $albumId) . "',
        '" . mysqli_real_escape_string($conn, $albumPrice) . "',
        '" . mysqli_real_escape_string($conn, $basketId) . "',
        '" . mysqli_real_escape_string($conn, $albumQtt) . "')";

    mysqli_query($conn, $sql);

    header("Location: ");

} else {
    print "Ups, something went wrong";
}


?>