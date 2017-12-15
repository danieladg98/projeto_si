<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Vinyl Records, lda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="products.css" rel="stylesheet">
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
        <div class="col-1">

        </div>
                <div class="lateral col-2">
                    <h2>OUR</h2>
                    <h2>PRODUCTS</h2>
                    <br>
                <form method="post" action="">
                    <input type="submit" name="newreleases" value="NEW RELEASES">
                    <input type="submit" name="mostwanted" value="MOST WANTED"><br>
                    <input type="submit" name="all" value="GENRE">
                    <div class="col-1">
                        <div class="in">
                        <input type="submit" name="all" value="All">
                        <input type="submit" name="blues" value="Blues">
                        <input type="submit" name="classical" value="Classical">
                        <input type="submit" name="country" value="Country">
                        <input type="submit" name="electronic" value="Electronic">
                        <input type="submit" name="indie" value="Indie">
                        <input type="submit" name="latin" value="Latin">
                        <input type="submit" name="rap" value="Rap">
                        <input type="submit" name="raggae" value="Raggae">
                        <input type="submit" name="rock" value="Rock">
                        <input type="submit" name="rb" value="R&B">
                        </div>
                    </div>
                </form>
                </div>

        <div class="col-9">

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
            if (isset($_POST['newreleases'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc limit 6");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['all'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['blues'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Blues' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['classical'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Classical' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['country'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Country' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['electronic'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Electronic' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['indie'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Indie' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['latin'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Latin' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['rap'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'rap' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['raggae'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Raggae' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['rock'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Rock' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            } else if (isset($_POST['rb'])) {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'R&B' order by release_date desc");
                $nrows = ceil(mysqli_num_rows($resultados) / 3);
                for ($i = 0; $i < $nrows; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($resultados)) {

                            print "<a class='mx-left' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";

                        }
                    }
                    print "</div>";
                }
            }


            ?>

        </div>
    </div>



</body>
<<<<<<< HEAD
</html>
=======
</html>
>>>>>>> 5c3fa8b80a1fba4756c5b55d2698272980e86ed6
