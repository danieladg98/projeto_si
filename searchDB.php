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

//Check whether userInput exists or not

if (isset($_GET['userInput'])) {
    $value = $_GET['userInput']; //assign the value
} else {
    echo "no input";
}
//Select query

$sql = "SELECT name, id FROM albums WHERE name LIKE '%" . $value . "%';";
if ($result = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($result) > 0) {
//Store the result in an array list[]

        while ($row = mysqli_fetch_array($result)) {
            $listname[] = $row['name'];
            $listid[] = $row['id'];
        }
    } else {
//set a null value to list[] if no result to prevent error
        $listname[] = "";
        $listid[] = "";
    }
}

if (!empty($value)) {
    if ($matched = preg_grep('~' . $value . '~', $listname)) {
        $count = 0;
        echo '<ul>';
        while ($count < 5) {
            if (isset($matched[$count])) {
                /*
                link the real target search file which should be opened when we click the search button or select the one from the drop down suggestion.
                */
                echo '<a href=vinyl.php?id=' . $listid[$count] . '><li>' . $matched[$count] . '</li></a>';
            }
            $count++;
        }
        echo '</ul>';
    } else {
        echo "No result";
    }
}

?>