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

    <div class="row">
        <div class="col-6">
            <?php echo "<img src='" . $albumImage . "'/>" ?>
            <!--<img src='img/cerdo%20patatero.jpg'/>-->
        </div>
        <div class="col-6">
            <?php
            if ($albumStock == 0) {
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
            <h6>Tracks: </h6>
            <?php
                $tracks = explode(",",$albumTracks);
                for($i=0;$i<count($tracks);$i++){
                    print "<p>".($i+1)." - ".$tracks[$i]."</p>";
                }
            ?>
            <?php print "<form class='form-group' action='parts/addtocart.php?id=".$_GET['id']."' method='post'>"?>
                <label>Select Quantity:</label>
                <br>
                <select id="" class="form-control" name="vinyl_quantity" onchange="changeFunc(value);">
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
                <br>
                <h6 id="price_tag">€ <?php print $albumPrice; ?></h6>
                <script type="text/javascript">

                    var price = <?php print $albumPrice; ?> ;

                    function changeFunc($i) {
                        price = <?php print $albumPrice; ?> ;
                        price = price * $i;
                        $("#price_tag").html("€ "+price);
                    }

                </script>
                <input class="btn btn-dark" type="submit" name="addtocart" value="ADD TO CART" >
            </form>
        </div>
    </div>
</div>


</body>
</html>