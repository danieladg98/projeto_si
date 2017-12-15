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

<div class=''>
    <div>
        <br>
        <br>
        <br>
    </div>
    <h2>Messages</h2>
    <div>
        <br>
        <br>
        <br>
    </div>

    <?php
    $resultados = mysqli_query($conn, "select id,message_date_time,content from messages");
    $nrows = ceil(mysqli_num_rows($resultados));

    for ($i = 0; $i < $nrows; $i++) {
        while ($linha = mysqli_fetch_assoc($resultados)) {

            print " <div class='col-8'>
                    <button  class='accordion justify'> " . $linha['message_date_time'] . " </button>

                    <div class='panel'>
                        <p>" . $linha['content'] . "</p>
                    </div>
                    </div>";
        }
    }
    for ($i = 0; $i < $nrows; $i++) {
        while ($linha = mysqli_fetch_assoc($resultados)) {
         $resultados_read = mysqli_query($conn, "select msg_read from messages_read WHERE clients_id ='{$_SESSION['user_id']}' AND messages_id = '{$linha['id']}'");
         $linha_read = mysqli_fetch_assoc($resultados);
        }
    }
    ?>

</div>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            <?php if ($linha_read['msg_read'] = 0) {
            $linha_read['msg_read'] = 1;
        }?>
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }

</script>
</body>
</html>

