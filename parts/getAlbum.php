<?php
$servername = "localhost";
$username = "root";
$password = "";
$bd = "Projeto_Si";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
    //Caso haja ligação executa o código abaixo!vv
}

$resultados = mysqli_query($conn, "select * from albums where id = ".$_GET['id'].";");
if (mysqli_num_rows($resultados) > 0 ) {
    $linha = mysqli_fetch_assoc($resultados);
    $albumId = $linha['id'];
    $albumName = $linha['name'];
    $albumDescription = $linha['description'];
    $albumRelease_date = $linha['release_date'];
    $albumGenre = $linha['genre'];
    $albumArtist = $linha['artist'];
    $albumPrice = $linha['price'];
    $albumImage = $linha['image'];
    $albumStock = $linha['stock'];
    $albumActive = $linha['active'];
} else {

    print "<script type='text/javascript'>
        window.location.href = '404.php';
        </script>";
}

?>