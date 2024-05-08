<?php function head($title)
{

?>

    <head>
        <title>GameScore | <?php echo $title; ?></title>
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <span id="izquierda">
                <p>¡Bienvenido a la página!</p>

                <p>Iniciar sesión...<img id="busqueda" class="icono" src="images/Usuario.png"></p>
                <nav>
                    <ul>
                        <li><a href="Index.html"><strong>Inicio</strong></a></li>
                        <li><a href="Seccion1.html"><strong>Sobre nosotros</strong></a></li>
                        <li><a href="Seccion2.html"><strong>Noticias</strong></a></li>
                        <li><a href="Seccion3.html"><strong>Reviews</strong></a></li>
                        <li><a href="Seccion4.html"><strong>Formulario</strong></a></li>
                    </ul>
                </nav>

            </span>

            <span id="derecha">
                <img class="logo" src="images/Logo.png">

                <p>Buscar artículo<img class="icono" src="images/Lupa.png"></p>
            </span>


        </header>



    <?php

}

    ?>