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

if(isset($_POST['search_submit'])){
    if(isset($_POST['searchInput']) && !empty($_POST['searchInput'])) {

        $searchInput = $_POST['searchInput'];



    } else {
        print "No data";
    }
}

?>