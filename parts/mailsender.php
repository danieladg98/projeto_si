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

$getMail = $_GET['email'];

$resultados = mysqli_query($conn, "select email, hash, password from clients where (email='$getMail');");
$linha = mysqli_fetch_assoc($resultados);
$clientEmail = $linha['email'];
$clientHash = $linha['hash'];
$clientPassword = $linha['password'];


$para = $clientEmail; // Send email to our user
$assunto = 'Signup Vinyl Records | Verificação Email'; // Give the email a subject
$mensagem = '
Obrigado por se registar em Vinyl Records!
A sua conta foi criada, pode fazer o login no nosso website com as credenciais que utilizou e confirmadas abaixo, logo após verificar a sua conta através do link fornecido.

------------------------
Email: ' . $clientEmail . '
Password: ' . $clientPassword . '
------------------------
                 
Utilize o link abaixo para verificar a sua conta:
http://localhost/projeto_si/verify.php?email=' . $clientEmail . '&hash=' . $clientHash . '
                
Nota: o acesso à àrea de cliente é restrita até confirmar o seu email.
 
';

$headers = 'From:noreply@vinylrecordslda.com'; // Nome de quem envia o link
mail($para, $assunto, $mensagem, $headers); // Envia o código

print "verifique a sua caixa de correio!";