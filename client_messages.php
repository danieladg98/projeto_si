<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Vinyl Records, lda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

</head>
<body>

<?php
session_start();

include_once 'parts/navbar.php';
include_once 'parts/verifyifloggedadmin.php';

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
?>

<div>
    $resultados = mysqli_query($conn, "select name, artist, id from albums where name='$escapedAlbumName' AND artist='$escapedArtist'");
    $linha = mysqli_fetch_assoc($resultados);
    mysqli_query($conn, "INSERT INTO musics (name , albums_id) VALUES(
    '" . mysqli_real_escape_string($conn, $escapedTracks) . "',
    '" . mysqli_real_escape_string($conn, $linha['id']) . "')") or die("Error: " . mysqli_error($conn));

</div>