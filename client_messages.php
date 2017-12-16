<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Vinyl Records, lda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="client_messages.css" rel="stylesheet">
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

include_once 'parts/navbar.php';
include_once 'parts/verifyifloggedclient.php';

$servername = "localhost";
$username = "root";
$password = "";
$bd = "Projeto_Si";
$conn = mysqli_connect($servername, $username, $password, $bd);
if (!$conn) {
    die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
    //Caso haja ligação executa o código abaixo!vv
}
?>
<div class='col-2'>
    <br>
    <br>
    <br>
    <h2>Messages</h2>
</div>

<div class='col-8'>

    <div>
        <br>
        <br>
        <br>
    </div>

    <form method="post" action="">
    <?php
    $user_id=$_SESSION['user_id'];
    $resultados = mysqli_query($conn, "select messages_id,msg_read,clients_id from message_read where clients_id='$user_id'");
    $nrows = ceil(mysqli_num_rows($resultados));
    for ($i = 0; $i < $nrows; $i++) {
        while ($linha = mysqli_fetch_assoc($resultados)) {
            $mensagem_id = $linha['messages_id'];
            $resultados2 = mysqli_query($conn, "select content,message_date_time from messages where id='$mensagem_id'");
            $linha2 = mysqli_fetch_assoc($resultados2);
            $msgid=$linha['messages_id'];
            mysqli_query($conn, "UPDATE message_read SET msg_read='1' WHERE messages_id='$msgid' AND clients_id='$user_id'");
            print " <div class='container border'>
                    <p class='justify'>" . $linha2['message_date_time'] . "</p>
                    <div class=''>
                        <p>" . $linha2['content'] . "</p>
                    </div>
                    </div>";
        }
    }

    ?>
    </form>
</div>

</body>
</html>

