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
include 'parts/getAlbum.php';
?>

<div>
    <br>
    <br>
    <br>
</div>


<div class="container">

    <img src=<?php echo $albumImage ?> />

    <?php
        if($albumStock == 0){
            print "<h4>Out of Stock</h4>";
        } else {
            print "<h4>In Stock</h4>";
        }
    ?>

    <h2><?php echo $albumArtist ?></h2>
    <h4><?php echo $albumName ?></h4>
    <p><?php echo $albumDescription ?></p>
    <h6>Release Date: <?php echo $albumRelease_date ?></h6>
    <h6>Genre: <?php echo $albumGenre ?></h6>

</div>


</body>
</html>