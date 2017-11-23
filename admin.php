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

<div class="col-md-2">
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Image</label>
        <input type="file" name="image" value=""/>
        <label for="album">Name</label>
        <input type="text" name="name" value=""/>
        <label for="genre">Artist</label>
        <input type="text" name="artist" value=""/>
        <label for="price">Release Date</label>
        <input type="text" name="release_date" value=""/>
        <label for="artist">Genre</label>
        <input type="text" name="genre" value=""/>
        <label for="stock">Price</label>
        <input type="text" name="price" value=""/>
        <label for="stock">Stock</label>
        <input type="text" name="stock" value=""/>
        <label for="stock">Tracks</label>
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
if ((isset($_POST['nome']) && !empty($_POST['nome'])) && (isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
    $escapedNome = mysqli_real_escape_string($conn, $_POST['nome']);
    $escapedMail = mysqli_real_escape_string($conn, $_POST['email']);
    $escapedPassword = mysqli_real_escape_string($conn, $_POST['password']);

    //Verifica se o email já existe na base de dados
    $resultados = mysqli_query($conn, "select email from clients where (email='$escapedMail');");
    if (mysqli_num_rows($resultados) > 0) {
        $linha = mysqli_fetch_assoc($resultados);
        if ($escapedMail == $linha['email']) {
            print "Email já existente!";
        }
        //caso o mail nao existir corre o codigo abaixo
    } else {
        //verifica se o mail é valido e está bem escrito
        if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $escapedMail)) {
            $msg = 'Email inválido, por favor tente de novo';
        } else {
            $msg = 'Conta criada, <br /> por favor verifique a sua conta através do link que enviamos para o seu email.';

            $hash = md5(rand(0, 1000));
            $passwordHashed = password_hash($escapedPassword, PASSWORD_DEFAULT);

            //inserção dos dados na base de dados
            mysqli_query($conn, "INSERT INTO clients (name , email , password , hash) VALUES(
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
