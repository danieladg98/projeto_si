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

$recordsStock = 0;
$totalSails = 0;
$lastMonthSails = 0;

$searchUsers = mysqli_query($conn, "select * from clients where active='1'");
$numClients = mysqli_num_rows($searchUsers);

$searchTRecords = mysqli_query($conn, "select * from albums");
$searchARecords = mysqli_query($conn, "select * from albums where active='1'");
$searchIRecords = mysqli_query($conn, "select * from albums where active='0'");

$numTRecords = mysqli_num_rows($searchTRecords);
$numARecords = mysqli_num_rows($searchARecords);
$numIRecords = mysqli_num_rows($searchIRecords);

$searchStock = mysqli_query($conn, "select stock from albums");
while($stockResult = mysqli_fetch_assoc($searchStock)) {
    $recordsStock += $stockResult['stock'];
}

$searchSails = mysqli_query($conn, "select total from compra");
while($sailsResult = mysqli_fetch_assoc($searchSails)) {
    $totalSails += $sailsResult['total'];
}


$searchLastSails = mysqli_query($conn, "select total from compra WHERE data_compra >= DATE_FORMAT( CURRENT_DATE - INTERVAL 1 MONTH, '%Y/%m/01' ) AND data_compra < DATE_FORMAT( CURRENT_DATE, '%Y/%m/01' ) ");
while($lastSailsResult = mysqli_fetch_assoc($searchSails)) {
    $lastMonthSails += $lastSailsResult['total'];
}

$searchArtist = mysqli_query($conn, "SELECT albums_id, COUNT(foo) AS fooCount FROM table GROUP BY fooORDER BY COUNT(foo) DESC");
while($sailsResult = mysqli_fetch_assoc($searchSails)) {
    $totalSails += $sailsResult['total'];
}

print "<h4>CLIENTS - $numClients</h4>";
print "<h4>TOTAL RECORDS - $numTRecords</h4>";
print "<h4>ACTIVE RECORDS - $numARecords</h4>";
print "<h4>INACTIVE RECORDS - $numIRecords</h4>";
print "<h4>RECORDS IN STOCK - $recordsStock</h4>";
print "<h4>TOTAL SAILS - € $totalSails</h4>";
print "<h4>LAST MONTH SAILS - $totalSails</h4>";
print "<h4>BEST SELLING ARTIST- $numClients</h4>";




?>

</body>
</html>
