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

<div class="col-md-3">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Image</label>
        <br/>
        <input type="file" name="album_cover" class="picture" value=""/>
        <p id="error1" style="display:none; color:#FF0000;">
            Invalid Image Format! Image Format Must Be JPG, JPEG, PNG or GIF.
        </p>
        <p id="error2" style="display:none; color:#FF0000;">
            Maximum File Size Limit is 1MB.
        </p>
        <br/>
        <br/>
        <label for="album">Name</label>
        <br/>
        <input type="text" name="name" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="genre">Artist</label>
        <br/>
        <input type="text" name="artist" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="price">Release Date (yyyy-mm-dd)</label>
        <br/>
        <input type="text" name="release_date" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="artist">Genre</label>
        <br/>
        <input type="text" name="genre" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="stock">Price</label>
        <br/>
        <input type="text" name="price" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="stock">Stock</label>
        <br/>
        <input type="text" name="stock" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="stock">Description</label>
        <br/>
        <input type="text" name="description" class="nonpicture" value=""/>
        <br/>
        <br/>
        <label for="stock">Tracks (separed by commas)</label>
        <br/>
        <input type="text" name="tracks" class="nonpicture" value=""/>

        <input type="submit" name="add" value="Add"/>
    </form>
</div>

<script>

    $('input[type="submit"]').prop("disabled", true);
    var a=0;
    //binds to onchange event of your input field
    $('.picture').bind('change', function() {
        if ($('input:submit').attr('disabled',false)){
            $('input:submit').attr('disabled',true);
        }
        var ext = $('.picture').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
            $('#error1').slideDown("slow");
            $('#error2').slideUp("slow");
            a=0;
        }else{
            var picsize = (this.files[0].size);
            if (picsize > 1000000){
                $('#error2').slideDown("slow");
                a=0;
            }else{
                a=1;
                $('#error2').slideUp("slow");
            }
            $('#error1').slideUp("slow");
            if (a===1){
                $('input:submit').attr('disabled',false);
            }
        }
    });
</script>

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

//verfica se add foi pressionado
if (isset($_POST['add'])) {
//Verifica se todos os campos do formulário foram preenchidos e não estão vazios
    if ((isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['artist']) && !empty($_POST['artist'])) && (isset($_POST['release_date']) && !empty($_POST['release_date'])) && (isset($_POST['genre']) && !empty($_POST['genre'])) && (isset($_POST['price']) && !empty($_POST['price'])) && (isset($_POST['stock']) && !empty($_POST['stock'])) && (isset($_POST['description']) && !empty($_POST['description'])) && (isset($_POST['tracks']) && !empty($_POST['tracks']))) {


        $escapedAlbumName = mysqli_real_escape_string($conn, $_POST['name']);
        $escapedArtist = mysqli_real_escape_string($conn, $_POST['artist']);
        $escapedReleaseDate = mysqli_real_escape_string($conn, $_POST['release_date']);
        $escapedGenre = mysqli_real_escape_string($conn, $_POST['genre']);
        $escapedPrice = mysqli_real_escape_string($conn, $_POST['price']);
        $escapedStock = mysqli_real_escape_string($conn, $_POST['stock']);
        $escapedDescription = mysqli_real_escape_string($conn, $_POST['description']);
        $escapedTracks = mysqli_real_escape_string($conn, $_POST['tracks']);
        $arrayTracks = explode(',', $escapedTracks);


//Verifica se o album já existe na base de dados
        $resultados = mysqli_query($conn, "select name,artist from albums where name='$escapedAlbumName' AND artist='$escapedArtist'");
        if (mysqli_num_rows($resultados) > 0) {
            $linha = mysqli_fetch_assoc($resultados);
            if ($escapedAlbumName == $linha['name'] && $escapedArtist == $linha['artist']) {
                print "This album already exists!";
            }
            //caso o album nao existir corre o codigo abaixo
        } else {

            if (($_FILES['album_cover']['name'] != "")) {
                // Where the file is going to be stored
                $target_dir = "img/albumCover/";
                $file = $_FILES['album_cover']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['album_cover']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;

                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                    echo "Image already exists.";
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);

                    //inserção dos dados na tabela albums
                    mysqli_query($conn, "INSERT INTO albums (name , description , release_date , genre, artist, price, image, stock) VALUES(
                    '" . mysqli_real_escape_string($conn, ucwords($escapedAlbumName)) . "',
                    '" . mysqli_real_escape_string($conn, $escapedDescription) . "',
                    '" . mysqli_real_escape_string($conn, $escapedReleaseDate) . "',
                    '" . mysqli_real_escape_string($conn, ucwords($escapedGenre)) . "',
                    '" . mysqli_real_escape_string($conn, ucwords($escapedArtist)) . "',
                    '" . mysqli_real_escape_string($conn, $escapedPrice) . "',
                    '" . "img/albumCover/" . $filename . "." . $ext . "',
                    '" . mysqli_real_escape_string($conn, $escapedStock) . "')") or die("Error: 1" . mysqli_error($conn));


                    $resultados = mysqli_query($conn, "select name, artist, id from albums where name='$escapedAlbumName' AND artist='$escapedArtist'");
                    $linha = mysqli_fetch_assoc($resultados);
                    mysqli_query($conn, "INSERT INTO musics (name , albums_id) VALUES(
                    '" . mysqli_real_escape_string($conn, $escapedTracks) . "',
                    '" . mysqli_real_escape_string($conn, $linha['id']) . "')") or die("Error: 2" . mysqli_error($conn));

                }
            }

        }
    } else {
        print "Please fill all the fields!";
    }
}


?>

</body>
</html>
