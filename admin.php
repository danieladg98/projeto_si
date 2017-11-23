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

<div class="col-md-3">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Image</label>
        <br/>
        <input type="file" name="image" value=""/>
        <br/>
        <br/>
        <label for="album">Name</label>
        <br/>
        <input type="text" name="name" value=""/>
        <br/>
        <br/>
        <label for="genre">Artist</label>
        <br/>
        <input type="text" name="artist" value=""/>
        <br/>
        <br/>
        <label for="price">Release Date</label>
        <br/>
        <input type="text" name="release_date" value=""/>
        <br/>
        <br/>
        <label for="artist">Genre</label>
        <br/>
        <input type="text" name="genre" value=""/>
        <br/>
        <br/>
        <label for="stock">Price</label>
        <br/>
        <input type="text" name="price" value=""/>
        <br/>
        <br/>
        <label for="stock">Stock</label>
        <br/>
        <input type="text" name="stock" value=""/>
        <br/>
        <br/>
        <label for="stock">Description</label>
        <br/>
        <input type="text" name="description" value=""/>
        <br/>
        <br/>
        <label for="stock">Tracks</label>
        <br/>
        <input type="text" name="tracks" value=""/>

        <input type="submit" name="signup_submit" value="Add"/>
    </form>
</div>

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

//Verifica se todos os campos do formulário foram preenchidos e não estão vazios
if ((getimagesize($FILES['image']['tmp-name'])==TRUE) && (isset($_POST['name']) && !empty($_POST['name']) && (isset($_POST['artist']) && !empty($_POST['artist']) && (isset($_POST['release_date']) && !empty($_POST['release_date']) && (isset($_POST['genre']) && !empty($_POST['genre']) && (isset($_POST['price']) && !empty($_POST['price']) && (isset($_POST['stock']) && !empty($_POST['stock'])) && (isset($_POST['description']) && !empty($_POST['description']) && (isset($_POST['tracks']) && !empty($_POST['tracks']))){
    $image= adslashes($FILES['image']['tmp-name']);
    $imagem= image_get_contents($image);
    $imagem= base64_encode($imagem);

$escapedAlbumName = mysqli_real_escape_string($conn, $_POST['name']);
$escapedArtist = mysqli_real_escape_string($conn, $_POST['artist']);
$escapedReleaseDate = mysqli_real_escape_string($conn, $_POST['release_date']);
$escapedGenre = mysqli_real_escape_string($conn, $_POST['genre']);
$escapedPrice = mysqli_real_escape_string($conn, $_POST['price']);
$escapedStock = mysqli_real_escape_string($conn, $_POST['stock']);
$escapedDescription = mysqli_real_escape_string($conn, $_POST['description']);
$escapedTracks = mysqli_real_escape_string($conn, $_POST['tracks']);

//Verifica se o email já existe na base de dados
$resultados = mysqli_query($conn, "select name,artist from albums where name='$escapedAlbumName' AND artist='$escapedArtist'");
if (mysqli_num_rows($resultados) > 0) {
    $linha = mysqli_fetch_assoc($resultados);
    if ($escapedAlbumName == $linha['name'] && $escapedArtist == $linha['artist'] ) {
        print "This album already exists!";
    }
    //caso o mail nao existir corre o codigo abaixo
} else {
    $msg = 'Album added successfully!';

    //inserção dos dados na base de dados
    mysqli_query($conn, "INSERT INTO albums (name , description , release_date , genre, artist, price, image, stock, active) VALUES(
            '" . mysqli_real_escape_string($conn, ucwords($escapedAlbumName)) . "',
            '" . mysqli_real_escape_string($conn, $escapedDescription) . "',
            '" . mysqli_real_escape_string($conn, $escapedReleaseDate) . "',
            '" . mysqli_real_escape_string($conn, $escapedGenre) . "',
           '" . mysqli_real_escape_string($conn, ucwords($escapedArtist)) . "',
            '" . mysqli_real_escape_string($conn, $escapedPrice) . "',
            '" . $image . "',
            '" . mysqli_real_escape_string($conn, $escapedStock) . "',
             '" . mysqli_real_escape_string($conn, '1') . "')") or die("Error: " . mysqli_connect_error());
}
} else {
    print "Please fill all the fields!";
}


?>

</body>
</html>
