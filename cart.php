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
    <script language="JavaScript" src="searchScript.js"></script>

</head>
<body>

<?php
session_start();
?>

<?php
include_once 'parts/navbar.php';

$servername = "localhost";
$username = "root";
$password = "";
$bd = "Projeto_Si";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
    //Caso haja ligação executa o código abaixo!vv
}

$getId = mysqli_query($conn, "select id from compra where clients_id='" . $_SESSION['user_id'] . "' AND finalizado='0'");
$linhaId = mysqli_fetch_assoc($getId);
$basketId = $linhaId['id'];

$albumsTotal = 0.00;

$resultados = mysqli_query($conn, "select single_total from produtos where compra_id='$basketId'");
while ($linha = mysqli_fetch_assoc($resultados)) {
    $albumsTotal += $linha['single_total'];
}

mysqli_query($conn, "UPDATE compra SET total ='" . $albumsTotal . "' WHERE clients_id = '" . $_SESSION['user_id'] . "' ") or die("Error: " . mysqli_error($conn));

?>

<div>
    <br>
    <br>
    <br>
</div>


<div class="container">
    <h2>Cart</h2>

    <?php


    $resultados = mysqli_query($conn, "select * from produtos, compra, albums where produtos.compra_id=compra.id and produtos.albums_id=albums.id and compra.clients_id='" . $_SESSION['user_id'] . "' and compra.finalizado='0'");
    $nrows = mysqli_num_rows($resultados);

    for ($i = 0; $i < $nrows; $i++) {
        while ($linha = mysqli_fetch_assoc($resultados)) {
            print "<div class='row'>
                      <div class='col-12'>
                        <div class='card border-0'>
                          <div class='card-body'>
                            <div class='row'>
                                <div class='col-2'>
                                <img class='card-img' src='" . $linha['image'] . "' alt='Card image cap'>
                                </div>
                                    <div class='col-10'>
                                    <div class='row'>
                                        <p class='card-text col-3'>" . $linha['name'] . "</p>
                                        <p class='card-text col-2 text-center'>PRICE</p>
                                        <p class='card-text col-3 text-center'>QTY</p>
                                        <p class='card-text col-2 text-center'>TOTAL</p>
                                        <p class='card-text col-2 text-center'>DELETE</p>
                                    </div>
                                    <div class='row'>
                                        <p class='card-text col-3'>" . $linha['artist'] . "</p>
                                        <p class='card-text col-2 text-center'>€ " . $linha['price'] . "</p>
                                        <div class='col-3 mx-auto'>
                                            <div class='row mx-auto'>
                                                <form action='' method='post'>
                                                    <select name='vinyl_id' style='display: none;'>
                                                        <option value='" . $linha['albums_id'] . "' selected></option>
                                                    </select>
                                                    <input class='btn text-center mx-auto' type='submit' name='remove_quantity' value='-'/>
                                                </form>
                                                <p class='card-text text-center mx-auto'>" . $linha['qtd'] . "</p>
                                                <form action='' method='post'>
                                                    <select name='vinyl_id' style='display: none;'>
                                                        <option value='" . $linha['albums_id'] . "' selected></option>
                                                    </select>
                                                    <input class='btn text-center mx-auto' type='submit' name='add_quantity' value='+'/>
                                                </form>
                                            </div>
                                        </div>
                                        <p class='card-text col-2 text-center'>€ " . $linha['single_total'] . "</p>
                                        <form class='col-2 mx-auto text-center' action='' method='post'>
                                            <select name='vinyl_id' style='display: none;'>
                                                <option value='" . $linha['albums_id'] . "' selected></option>
                                            </select>
                                            <input class='btn text-center mx-auto' type='submit' name='remove_album' value='X'/>
                                        </form>
                                    </div>
                                </div>
                         
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  ";
        }
    }
    ?>

    <?php
    if ($nrows == 0) {
        print "It seems your cart its empty!";
    } else {
        print "<div class='row justify-content-end'>
                    <table>
                        <tbody>
                        <tr>
                            <td class='align-bottom'><h4 class='mx-4'>Total:</h4></td>
                            <td class='align-bottom'><h5 class='mx-4'>€ $albumsTotal</h5></td>
                            <td class='align-bottom'><a class='btn btn-dark mx-4 px-5 text-white' data-toggle='modal' data-target='#checkoutModal'>CHECKOUT</a></td>
                        </tr>
                        </tbody>
                    </table>
               </div>";
    }
    ?>

</div>

<!-- Modal de checkout -->
<div class="modal fade" id="checkoutModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Checkout</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="row">
                    <h5 class="mx-auto mb-4">Are you sure you want to proceed with checkout?</h5>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary mx-auto px-5" data-dismiss="modal">No</button>
                    <form action="" method="post" class="mx-auto">
                        <input class="btn btn-primary px-5" type="submit" name="checkout_submit" value="Yes"/>
                    </form>
                </div>

            </div>

            <?php include "parts/checkout.php"; ?>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
            </div>

        </div>
    </div>
</div>

<?php

//verfica se add foi pressionado
if (isset($_POST['add_quantity'])) {

    $albumId = $_POST['vinyl_id'];

    $resultados = mysqli_query($conn, "SELECT albums_id FROM produtos WHERE albums_id = '$albumId' AND compra_id='$basketId'");
    $linha = mysqli_fetch_assoc($resultados);

    $getPrice = mysqli_query($conn, "select price from albums where id='$albumId'");
    $linhaPrice = mysqli_fetch_assoc($getPrice);
    $albumPrice = $linhaPrice['price'];

    $getCurrentQtt = mysqli_query($conn, "select qtd from produtos where albums_id='$albumId';");
    $linhaQtt = mysqli_fetch_assoc($getCurrentQtt);
    $currentQtt = $linhaQtt['qtd'];

    $updatedQtt = $currentQtt + 1;
    $updatedPrice = $updatedQtt * $albumPrice;

    mysqli_query($conn, "UPDATE produtos SET qtd ='" . $updatedQtt . "', single_total = '$updatedPrice' WHERE albums_id = '$albumId' ") or die("Error: " . mysqli_error($conn));

    header("Refresh:0");
}

if (isset($_POST['remove_quantity'])) {
    $albumId = $_POST['vinyl_id'];

    $resultados = mysqli_query($conn, "SELECT albums_id FROM produtos WHERE albums_id = '$albumId' AND compra_id='$basketId'");
    $linha = mysqli_fetch_assoc($resultados);

    $getPrice = mysqli_query($conn, "select price from albums where id='$albumId'");
    $linhaPrice = mysqli_fetch_assoc($getPrice);
    $albumPrice = $linhaPrice['price'];

    $getCurrentQtt = mysqli_query($conn, "select qtd from produtos where albums_id='$albumId';");
    $linhaQtt = mysqli_fetch_assoc($getCurrentQtt);
    $currentQtt = $linhaQtt['qtd'];

    $updatedQtt = $currentQtt - 1;
    $updatedPrice = $updatedQtt * $albumPrice;

    mysqli_query($conn, "UPDATE produtos SET qtd ='" . $updatedQtt . "', single_total = '$updatedPrice' WHERE albums_id = '$albumId' ") or die("Error: " . mysqli_error($conn));

    header("Refresh:0");
}

if (isset($_POST['remove_album'])) {
    $albumId = $_POST['vinyl_id'];

    mysqli_query($conn, "DELETE FROM produtos WHERE albums_id='$albumId'") or die("Error: " . mysqli_error($conn));

    header("Refresh:0");
}

?>

</body>
</html>