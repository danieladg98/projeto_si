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

    $getCart = mysqli_query($conn, "select id from compra where clients_id='".$_SESSION['user_id']."'");
    $linhaCart = mysqli_fetch_assoc($getCart);
    $cartId = $linhaCart['id'];

    $getPrice = mysqli_query($conn, "select price from albums where id='$albumId'");
    $linhaPrice = mysqli_fetch_assoc($getPrice);
    $albumPrice = $linhaPrice['price']*$albumQtt;

    $getId = mysqli_query($conn, "select id from compra where clients_id='".$_SESSION['user_id']."' AND finalizado='0'");
    $linhaId = mysqli_fetch_assoc($getId);
    $basketId = $linhaId['id'];

    //verifica se o album já está no inventário e caso esteja, atualiza os valores
    $resultados = mysqli_query($conn, "SELECT albums_id FROM produtos WHERE albums_id = '$albumId' AND compra_id='$basketId'");
    if(mysqli_num_rows($resultados) == 1) {
        $linha = mysqli_fetch_assoc($resultados);

        $getCurrentQtt = mysqli_query($conn, "select qtd from produtos where albums_id='$albumId';");
        $linhaQtt = mysqli_fetch_assoc($getCurrentQtt);
        $currentQtt = $linhaQtt['qtd'];

        $updatedQtt = $currentQtt + $albumQtt;
        $updatedprice = $updatedQtt * $linhaPrice['price'];

        mysqli_query($conn,"UPDATE produtos SET qtd ='".$updatedQtt."', single_total = '$updatedprice' WHERE albums_id = '".$linha['albums_id']."' ") or die("Error: " . mysqli_error($conn));

    } else {

        //inserção dos dados na tabela produtos
        $sql = "INSERT INTO produtos (albums_id, single_total, compra_id, qtd) VALUES(
        '" . mysqli_real_escape_string($conn, $albumId) . "',
        '" . mysqli_real_escape_string($conn, $albumPrice) . "',
        '" . mysqli_real_escape_string($conn, $basketId) . "',
        '" . mysqli_real_escape_string($conn, $albumQtt) . "')" or die("Error: " . mysqli_error($conn));

        mysqli_query($conn, $sql);
    }

    header("Location: ../cart.php");

} else {
    print "Ups, something went wrong";
}


?>