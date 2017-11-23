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
if ((isset($_POST['image']) && !empty($_POST['image'])) && (isset($_POST['name']) && !empty($_POST['name'])) && (isset($_POST['artist']) && !empty($_POST['artist']) && (isset($_POST['release_date']) && !empty($_POST['release_date']) && (isset($_POST['genre']) && !empty($_POST['genre']) && (isset($_POST['price']) && !empty($_POST['price']) && (isset($_POST['stock']) && !empty($_POST['stock']) && (isset($_POST['description']) && !empty($_POST['description']) && (isset($_POST['tracks']) && !empty($_POST['tracks']))){$escapedImage = mysqli_real_escape_string($conn, $_POST['image']);
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
        print "Album já existente!";
    }
    //caso o mail nao existir corre o codigo abaixo
} else {
        $msg = 'Conta criada, <br /> por favor verifique a sua conta através do link que enviamos para o seu email.';

        //inserção dos dados na base de dados
        mysqli_query($conn, "INSERT INTO albums (name , email , password , hash) VALUES(
            '" . mysqli_real_escape_string($conn, ucwords($escapedNome)) . "',
            '" . mysqli_real_escape_string($conn, $escapedMail) . "',
            '" . mysqli_real_escape_string($conn, $passwordHashed) . "',
            '" . mysqli_real_escape_string($conn, $hash) . "')") or die("Erro na criação de conta: " . mysqli_connect_error());

        $para = $escapedMail; // Send email to our user
        $assunto = 'Signup Vinyl Records | Verificação Email'; // Give the email a subject
        $mensagem = '
 
                Obrigado por se registar em Vinyl Records!
                A sua conta foi criada, pode fazer o login no nosso website com as credenciais que utilizou e confirmadas abaixo, logo após verificar a sua conta através do link fornecido.
                
                ------------------------
                Email: ' . $escapedMail . '
                Password: ' . $escapedPassword . '
                ------------------------
                 
                Utilize o link abaixo para verificar a sua conta:
                http://localhost:63342/Projeto%20SI/verify.php?email=' . $escapedMail . '&hash=' . $hash . '
                
                Nota: o acesso à àrea de cliente é restrita até confirmar o seu email.
 
                ';

        $headers = 'From:noreply@vinylrecordslda.com'; // Nome de quem envia o link
        mail($para, $assunto, $mensagem, $headers); // Envia o código

        mysqli_close($conn);
    }
}

}


?>

</body>
</html>
