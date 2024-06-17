<?php 
session_start();
function head($title)
{

?>  
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GameScore | <?php echo $title; ?></title>
        <link rel="icon" href="images/Logo.ico" type="image/x-icon">
        <?php if($title == "Contacto"){
            ?>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
            <?php
        } ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <?php
            if ($title == "Sobre Nosotros"){
        ?> 
        <link rel="stylesheet" href="css/nosotros.css" type="text/css">
        <?php
            }
        ?>
        <?php
            if ($title == "Noticias" || $title == "Reviews" || $title == "Articulos"){
        ?> 
        <link rel="stylesheet" href="css/noticias-reviews.css" type="text/css">
        <?php
            }
        ?>
        <?php
            if ($title == "Artículo"){
        ?> 
        <link rel="stylesheet" href="css/articulo.css" type="text/css">
        <?php
            }
        ?>
        <?php
            if ($title == "Videojuego"){
        ?> 
        <link rel="stylesheet" href="css/videojuego.css" type="text/css">
        <?php
            }
        ?>
        <?php
            if ($title == "Inicio"){
        ?> 
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <?php
            }
        ?>
        <?php
            if ($title == "Gestión de Videojuegos" || $title == "Gestión de Usuarios" || $title == "Gestión de Artículos"){
        ?> 
        <link rel="stylesheet" href="css/cruds.css" type="text/css">
        <?php
            }
        ?>
        <?php
            if ($title == "Contacto"){
        ?> 
        <link rel="stylesheet" href="css/contacto.css" type="text/css">
        <?php
            }
        ?>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">

    </head>

    <body>
        <header>
            <span id="derecha">
                <a href="index.php">
                <img class="logo" src="images/Logo.png" alt="Logo GameScore">
                </a>
            </span>

            <button id="toggle-menu">Menú</button>
                <nav id="menu">
                    <ul>
                        <li><a href="index.php"><strong>Inicio</strong></a></li>
                        <li><a href="nosotros.php"><strong>Sobre Nosotros</strong></a></li>
                        <li><a href="noticias.php"><strong>Noticias</strong></a></li>
                        <li><a href="reviews.php"><strong>Reviews</strong></a></li>
                        <?php if(!isset($_SESSION['rol'])){
                            ?>
                        <li><a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"><strong>Iniciar Sesión</strong></a></li>
                            <?php
                        } 
                        ?>
                    </ul>
                </nav>
                <?php 
                if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1){
                            ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong><?php echo $_SESSION['username'] ?></strong>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="#" role="button" id="btn_cerrar_sesion">Cerrar Sesión</a></li>
                                <div class="dropdown-divider"></div>
                                <li><a class="dropdown-item" href="gestionar_videojuegos.php">Gestionar Videojuegos</a></li>
                                <li><a class="dropdown-item" href="gestionar_articulos.php">Gestionar Articulos</a></li>
                                <li><a class="dropdown-item" href="gestionar_usuarios.php">Gestionar Usuarios</a></li>
                            </ul>
                        </div>
                            <?php
                } else if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2){
                        ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <strong><?php echo $_SESSION['username'] ?></strong>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="#" role="button"  id="btn_cerrar_sesion">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                        <?php
                }
                        ?>
                

        </header>

    <?php

}

    ?>