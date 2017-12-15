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

if (isset($_POST['checkout_submit'])) {

    $searchUser = mysqli_query($conn, "select * from clients where id='" . $_SESSION['user_id'] . "'");
    $rowUser = mysqli_fetch_assoc($searchUser);
    $userBalance = $rowUser['balance'];

    $searchCart = mysqli_query($conn, "select * from compra where clients_id='" . $_SESSION['user_id'] . "' and finalizado='0';");
    $rowCart = mysqli_fetch_assoc($searchCart);
    $cartTotal = $rowCart['total'];

    $searchCart = mysqli_query($conn, "select * from produtos where id='" . $_SESSION['user_id'] . "' and finalizado='0';");
    $rowCart = mysqli_fetch_assoc($searchCart);
    $cartTotal = $rowCart['total'];

//verifica se o utilizador tem dinheiro suficiente para realizar a compra
    if ($userBalance >= $cartTotal) {

        $updatedBalance = $userBalance - $cartTotal;
        $currentTimestamp = date('Y-m-d G:i:s');

        mysqli_query($conn,"UPDATE compra SET data_compra ='".$currentTimestamp."', finalizado = '1' where clients_id='" . $_SESSION['user_id'] . "' and finalizado='0'") or die("Error: " . mysqli_error($conn));
        mysqli_query($conn, "INSERT INTO compra (clients_id) VALUES('" . $_SESSION['user_id'] . "')") or die("Error: " . mysqli_error($conn));
        mysqli_query($conn,"UPDATE clients SET balance ='".$updatedBalance."' where id='" . $_SESSION['user_id'] . "'") or die("Error: " . mysqli_error($conn));
        mysqli_query($conn,"UPDATE albums SET stock ='".$updatedBalance."' where id='" . $_SESSION['user_id'] . "'") or die("Error: " . mysqli_error($conn));

        header("Refresh:0");

    } else {

        print "Não existem fundo suficientes para finalizar a sua compra!";
        print "<script type='text/javascript'>
              $(document).ready(function(){
                $('#checkoutModal').modal('show');
              });
           </script>";

    }
}