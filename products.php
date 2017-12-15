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
            <input type="submit" name="new" value="NEW RELEASES">
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
        print"<div class='row order_date'>
            <form class='col-11 alinhar_d' method='post' action=''>
           <button type='button' class='btn' data-toggle='collapse' data-target='#demo'>DATE</button>
                <div id='demo' class='collapse'>
                     <input type='submit' name='asc_d' value='Ascending'><br>
                    <input type='submit' name='desc_d' value='Descending'>
                </div>
   </form>
   <br>
   <br>
   <br>
   <br>
   <br>
   </div>";

        if (isset($_POST['new'])) {
            header('Location: products.php?message=new');
        } else if (isset($_POST['all'])) {
            header('Location: products.php?message=all');
        } else if (isset($_POST['blues'])) {
            header('Location: products.php?message=Blues');
        } else if (isset($_POST['classical'])) {
            header('Location: products.php?message=Classical');
        } else if (isset($_POST['country'])) {
            header('Location: products.php?message=Country');
        } else if (isset($_POST['electronic'])) {
            header('Location: products.php?message=Electronic');
        } else if (isset($_POST['indie'])) {
            header('Location: products.php?message=Indie');
        } else if (isset($_POST['latin'])) {
            header('Location: products.php?message=Latin');
        } else if (isset($_POST['rap'])) {
            header('Location: products.php?message=Rap');
        } else if (isset($_POST['raggae'])) {
            header('Location: products.php?message=Raggae');
        } else if (isset($_POST['rock'])) {
            header('Location: products.php?message=Rock');
        } else if (isset($_POST['rb'])) {
            header('Location: products.php?message=R&B');
        } else {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc limit 6");
        }

        if ($_GET['message'] == 'new') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc limit 6");
        } else if ($_GET['message'] == 'all') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc");
        } else if ($_GET['message'] == 'Blues') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Blues' order by release_date desc");
        } else if ($_GET['message'] == 'Classical') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Classical' order by release_date desc");
        } else if ($_GET['message'] == 'Country') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Country' order by release_date desc");
        } else if ($_GET['message'] == 'Electronic') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Electronic' order by release_date desc");
        } else if ($_GET['message'] == 'Indie') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Indie' order by release_date desc");
        } else if ($_GET['message'] == 'Latin') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Latin' order by release_date desc");
        } else if ($_GET['message'] == 'Rap') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'rap' order by release_date desc");
        } else if ($_GET['message'] == 'Raggae') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Raggae' order by release_date desc");
        } else if ($_GET['message'] == 'Rock') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'Rock' order by release_date desc");
        } else if ($_GET['message'] == 'R&B') {
            $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = 'R&B' order by release_date desc");
        } else {
            header('Location: products.php?message=new');
        }

        if (isset($_POST['asc_d'])) {
            $get_genre = $_GET['message'];
            if ($get_genre == 'all') {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date asc");
            } if ($get_genre == 'new') {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date asc limit 6");
            }else {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = '$get_genre' order by release_date asc");
            }
        } else if (isset($_POST['desc_d'])) {
            $get_genre = $_GET['message'];
            if ($get_genre == 'all') {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc");
            } if ($get_genre == 'new') {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 order by release_date desc limit 6");
            }else {
                $resultados = mysqli_query($conn, "select id, artist, name, genre, release_date, price, image from albums where active = 1 AND genre = '$get_genre' order by release_date desc");
            }
        }


        $nrows = ceil(mysqli_num_rows($resultados) / 3);
        for ($i = 0; $i < $nrows; $i++) {
            print "<div class='row'>";
            for ($j = 0; $j < 3; $j++) {
                while ($linha = mysqli_fetch_assoc($resultados)) {

                    print "<a class='mx-2' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
                        <img class='card-img-top' src='" . $linha['image'] . "' alt='Card image cap'>
                        <div class='card-block'>
                            <h4 class='card-title'>" . $linha['name'] . "</h4>
                            <p class='card-text'>" . $linha['artist'] . "</p>
                            <p class='card-text'>€ " . $linha['price'] . "</p>
                        </div>
                    </div></a>
                  ";
                }

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


                        print "</div>";
                    }
                }
            }
        }



        ?>

    </div>
</div>

</body>

</html>


