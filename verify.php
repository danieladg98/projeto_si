<!DOCTYPE html>
<html lang="en">
<head
    <title>Vinyl Records - Verificação de Email</title>
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

<div>

    <?php
    //Ligação à base de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $bd = "Projeto_Si";
    $conn = mysqli_connect($servername, $username, $password, $bd);
    if (!$conn) {
        die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
        //Caso haja ligação executa o código abaixo!
    }

    //Verifica se recebeu as variáveis 'mail' e 'hash'
    if ((isset($_GET['email']) && !empty($_GET['email'])) && (isset($_GET['hash']) && !empty($_GET['hash']))) {
        $escapedMail = mysqli_real_escape_string($conn, $_GET['email']);
        $escapedHash = mysqli_real_escape_string($conn, $_GET['hash']);

        $procura = mysqli_query($conn, "select email, hash, active from clients where email='" . $escapedMail . "' && hash='" . $escapedHash . "' && active='0'") or die (mysqli_connect_error());
        $resultados = mysqli_num_rows($procura);

        if ($resultados > 0) {
            //pesquisa deu sucesso e conta pode ser ativada
            mysqli_query($conn, "update clients set active='1' where email='" . $escapedMail . "' && hash='" . $escapedHash . "' && active='0' ") or die (mysqli_connect_error());
            print "<h2> A sua conta foi ativada, já pode entrar e utilizar a sua conta</h2>";
        } else {
            //ocorreu um erro
            print("url inválido ou conta já foi ativada!");
        }

    } else {
        //mensagem a imprimir caso o prenchimento dos dados ao inicio tenha sido inválido
        echo "Ups ocurreu um erro ao validar o email, use o email fornecido no email enviado!";
    }

    ?>

    <a type="button" class="btn btn-primary" href="index.php">Voltar</a>


</div>

</body>
</html>