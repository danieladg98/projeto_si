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

//verfica se search_edit foi pressionado
if (isset($_POST['album_search_edit'])) {
    $adminInput = $_POST['adminInput_edit'];

    if($adminInput != '') {
        $resultados = mysqli_query($conn,"SELECT name, id FROM albums WHERE name LIKE '%" . $adminInput . "%';");
        $nrows = mysqli_num_rows($resultados);

        if ($nrows > 0) {

            while($linha = mysqli_fetch_assoc($resultados)) {
                print "<div>
                        <a href='admin.php?id=".$linha['id']."&action=edit'>".$linha['name']."</a>
                   </div>";

            }
        }
    }

}