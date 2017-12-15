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

    <h2>Search</h2>

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

    if(isset($_POST['search_submit'])){
        if(isset($_POST['searchInput']) && !empty($_POST['searchInput'])) {

            $searchInput = $_POST['searchInput'];

            $searchAlbum = mysqli_query($conn, "SELECT * FROM albums WHERE name LIKE '%" . $searchInput . "%';");
            $searchMusic = mysqli_query($conn, "SELECT musics.name as musics_name, albums_id, id, albums.name, artist, active FROM musics, albums WHERE musics.albums_id=albums.id and musics.name LIKE '%" . $searchInput . "%';");
            $rowsAlbum = mysqli_num_rows($searchAlbum);
            $rowsMusic = mysqli_num_rows($searchMusic);

            $nrowsA = ceil(mysqli_num_rows($searchAlbum) / 3);
            $nrowsM = ceil(mysqli_num_rows($searchMusic) / 3);

            if ($rowsAlbum > 0) {
                print "<h5>Searching for albuns:</h5>";
                for ($i = 0; $i < $nrowsA; $i++) {
                    print "<div class='row'>";
                    for ($j = 0; $j < 3; $j++) {
                        while ($linha = mysqli_fetch_assoc($searchAlbum)) {

                            print "<a class='mx-3' href='vinyl.php?id=" . $linha['id'] . "'><div class='card border-0' style='width: 20rem;'>
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
            } else {
                print "<h5>Searching for albuns:</h5>";
                print "Nothing to show";
            }
            if ($rowsMusic > 0) {

                    print "<h5>Searching for Musics:</h5>";
                    for ($i = 0; $i < $rowsMusic; $i++) {
                        while ($linha = mysqli_fetch_assoc($searchMusic)) {
                            $musicas = explode(",",$linha['musics_name']);
                            if ($matched = preg_grep('~' . $searchInput . '~i', $musicas)) {
                                $count = 0;
                                print '<ul>';
                                while ($count < count($musicas)) {
                                    if (isset($matched[$count])) {
                                        /*
                                        link the real target search file which should be opened when we click the search button or select the one from the drop down suggestion.
                                        */
                                        echo "<a href=vinyl.php?id='" . $linha['albums_id'] . "'><li>" . $linha['artist'] . " - " . $matched[$count] . "</li></a>";
                                    }
                                    $count++;
                                }
                                print '</ul>';
                            }
                        }
                    }
                }

            } else {
                print "No data";
            }
        }


    ?>


</div>


</body>
