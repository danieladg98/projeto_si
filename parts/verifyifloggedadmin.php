<?php

if(!isset($_SESSION['loggedin'])) {
    if($_SESSION['admin'] == false) {
        // not logged in
        header('Location: index.php?error=login&msg=error001');
        exit();
    }
}

if(isset($_SESSION['loggedin']) && isset($_SESSION['admin'])) {
    if($_SESSION['admin'] == false) {
        // not logged in
        header('Location: 404.php');
        exit();
    }
}

?>