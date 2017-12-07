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


//Verifica se o botão de registo já foi carregado ou não
if (isset($_POST['login_submit'])) {

    //Verifica se todos os campos do formulário foram preenchidos e não estão vazios
    if ((isset($_POST['email']) && !empty($_POST['email'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
        $escapedMail = mysqli_real_escape_string($conn, $_POST['email']);
        $escapedPassword = mysqli_real_escape_string($conn, $_POST['password']);


        //Verifica na base de dados se o email existe
        $resultados = mysqli_query($conn, "select email, password, active from clients where email='$escapedMail';");
        $resultados2 = mysqli_query($conn, "select email, password from admins where email='$escapedMail';");
        if (mysqli_num_rows($resultados) > 0 && mysqli_num_rows($resultados2) == 0) {
            $linha = mysqli_fetch_assoc($resultados);
            if ($escapedMail === $linha['email']) {

                if ($linha['active'] == 0) {
                    print "Por favor ative a sua conta!";
                    print "<a class='btn btn-primary' href='parts/mailsender.php?email=".$linha['email']."'>Re send</a>";
                    print "<script type='text/javascript'>
                    $(document).ready(function(){
                        $('#loginModal').modal('show');
                    });
                    </script>";
                } else {
                    //verifica se a password da conta está correta
                    if (password_verify($escapedPassword, $linha['password'])) {
                        $resultados = mysqli_query($conn, "select * from clients where email='$escapedMail';");
                        $linha = mysqli_fetch_assoc($resultados);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['admin'] = false;
                        $_SESSION['name'] = $linha['name'];
                        header("Refresh:0");
                        exit;
                    } else {
                        print "Password incorreta!";

                        print "<script type='text/javascript'>
                        $(document).ready(function(){
                            $('#loginModal').modal('show');
                        });
                       </script>";
                    }
                }
            }

        } else if (mysqli_num_rows($resultados) == 0 && mysqli_num_rows($resultados2) > 0) {

            $linha2 = mysqli_fetch_assoc($resultados2);
            if ($escapedMail === $linha2['email']) {
                //verifica se a password da conta está correta
                if ($escapedPassword == $linha2['password']) {
                    $resultados2 = mysqli_query($conn, "select * from admins where email='$escapedMail';");
                    $linha2 = mysqli_fetch_assoc($resultados2);
                    $_SESSION['loggedin'] = true;
                    $_SESSION['admin'] = true;
                    $_SESSION['name'] = $linha2['name'];
                    header("Refresh:0");
                    exit;
                } else {
                    print "Password incorreta!";

                    print "<script type='text/javascript'>
                        $(document).ready(function(){
                            $('#loginModal').modal('show');
                         });
                       </script>";
                }
            }

        } else {
            print "Erro ao efetuar o login. Por favor registe-se ou confirme os seus dados.";

            print "<script type='text/javascript'>
                        $(document).ready(function(){
                            $('#loginModal').modal('show');
                         });
                       </script>";
        }

    } else {
        //mensagem a imprimir caso o prenchimento dos dados ao inicio tenha sido inválido
        echo "erro a preencher o formulário";
    }
}

if (isset($msg)) {
    print "<h3>" . $msg . "</h3>";
}

?>
