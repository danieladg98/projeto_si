<?php

if(!isset($_SESSION['loggedin']) && !isset($_SESSION['user_id']))
{
    // not logged in
    $page_errors = "not logged in";
    header('Location: index.php?error=login&msg=error001');

    exit();
}

?>