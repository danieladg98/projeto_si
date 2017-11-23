<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <a class="navbar-brand" href="index.php">Vinyl Records</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">New Releases</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Vinyl</a>
            </li>
            <li class="nav-item dropdown">
                <i class="nav-link fa fa-search" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <form class="form-inline dropdown-item">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </li>
            <li class="nav-item dropdown">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $bd = "Projeto_Si";
                $conn = mysqli_connect($servername, $username, $password, $bd);
                if (!$conn) {
                    die("Erro na ligacao: " . mysqli_connect_error()); //Mensagem de erro caso nao haja ligação à base de dados
                    //Caso haja ligação executa o código abaixo!vv
                }

                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

                    print '<a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> ' . $_SESSION['name'] . ' </a>';

                    if($_SESSION['admin'] == true) {
                           print '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-right" href="admin.php">Dashboard</a>
                                <a class="dropdown-item text-right" href="logout.php">Log Out</a>
                           </div>';
                    } else {
                       print  '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-right" href="client.php">My Account</a>
                                <a class="dropdown-item text-right" href="logout.php">Log Out</a>
                           </div>';
                    }
                } else {
                    print '<a class="nav-link" data-toggle="modal" data-target="#loginModal">Log In</a>';
                }
                ?>
            </li>
            <li class="nav-item">
                <i class="nav-link fa fa-shopping-bag" href="#"></i>
            </li>
        </ul>
    </div>
</nav>

