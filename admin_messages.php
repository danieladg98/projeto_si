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
include_once 'parts/verifyifloggedadmin.php';
?>

<div>
    <br>
    <br>
    <br>
</div>

<div class="col-md-3">
    <form action="" method="post">
        <label for="stock">Message</label>
        <br/>
        <textarea name="message_content" rows="10" cols="50" id="message"></textarea>
        <br/>
        <br/>
        <input type="submit" name="send_message" value="Send Message"/>
    </form>
</div>

<script>

    $('input:submit').attr('disabled', true);

    $('#message').bind('input propertychange', function () {

        if (!$.trim($("#message").val())) {
            $('input:submit').attr('disabled', true);
        } else {
            $('input:submit').attr('disabled', false);
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

//verfica se send_message foi pressionado
if (isset($_POST['send_message'])) {
//Verifica se todos os campos do formulário foram preenchidos e não estão vazios
    if ((isset($_POST['message_content']) && !empty($_POST['message_content']))) {

        $escapedMessage = mysqli_real_escape_string($conn, $_POST['message_content']);
        $currentTimestamp = date('Y-m-d G:i:s');
        $writerId = $_SESSION['user_id'];

        //inserção dos dados na tabela mensagens
        $sql = "INSERT INTO messages (message_date_time, content , admins_id) VALUES(
        '" . mysqli_real_escape_string($conn, $currentTimestamp) . "',
        '" . mysqli_real_escape_string($conn, $escapedMessage) . "',
        '" . mysqli_real_escape_string($conn, $writerId) . "')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;

            $resultados = mysqli_query($conn, "select id from clients");

            while ($linha = mysqli_fetch_assoc($resultados)) {
                mysqli_query($conn, "INSERT INTO message_read (messages_id , clients_id) VALUES(
                    '" . mysqli_real_escape_string($conn, $last_id) . "',
                    '" . mysqli_real_escape_string($conn, $linha['id']) . "')") or die("Error 1: " . mysqli_error($conn));
            }

            echo "<script type='text/javascript'>alert('Message sent with id: ".$last_id."');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    } else {
        $message = "Message field is empty!";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}


?>

</body>
</html>
