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



    <div class="row">
                <div class="col-3">

                </div>
        <div class="col-9">
            <h2>Our Products</h2>

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

            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc");
            $nrows = ceil(mysqli_num_rows($resultados)/3);

            for ($i = 0; $i < $nrows; $i++) {
                print "<div class='row'>";
                for($j = 0; $j < 3; $j++) {
                    while ($linha = mysqli_fetch_assoc($resultados)) {

                        print "<a class='mx-left' href='vinyl.php?id=".$linha['id']."'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>".$linha['name']."</h4>
                            <p class='card-text'>".$linha['artist']."</p>
                            <p class='card-text'>€ ".$linha['price']."</p>
                        </div>
                    </div></a>
                  ";

                    }
                }
                print "</div>";
            }


            ?>

        </div>
    </div>



</body>
