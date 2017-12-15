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
?>

<div>
    <br>
    <br>
    <br>
</div>


<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Purchases</h2>

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

            $searchRows = mysqli_query($conn, "select DISTINCT compra_id from compra, produtos, albums where produtos.compra_id = compra.id and produtos.albums_id=albums.id and compra.clients_id='" . $_SESSION['user_id'] . "' and compra.finalizado='1' order by compra.data_compra desc");
            $nrows = mysqli_num_rows($searchRows);

            $searchDates = mysqli_query($conn, "select data_compra, total from compra where clients_id='" . $_SESSION['user_id'] . "' and finalizado = '1'");

            for ($i = 0; $i < $nrows; $i++) {
                while($buyDates = mysqli_fetch_assoc($searchDates)){
                    print "<div class='row'><h4>".$buyDates['data_compra']."</h4></div>";
                    print "<div class='row'>";
                        $resultados = mysqli_query($conn, "select * from compra, produtos, albums where produtos.compra_id = compra.id and produtos.albums_id=albums.id and compra.clients_id='" . $_SESSION['user_id'] . "' and compra.finalizado='1' and compra.data_compra='".$buyDates['data_compra']."'order by compra.data_compra desc");
                        while ($linha = mysqli_fetch_assoc($resultados)) {
                            print "<div class='card border-0 col-4' style='width: 20rem;'>
                                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                                        <div class='card-block'>
                                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                                            <p class='card-text'>" . $linha['artist'] . "</p>
                                            <p class='card-text'>x " . $linha['qtd'] . " € " . $linha['single_total'] . "</p>
                                         </div>
                                  </div>
                                  ";

                        }
                    print "<h4> Total:  ".$buyDates['total']."</h4>";
                    print "</div>";
                }
            }


            ?>

        </div>

</div>


</body>
</html>
