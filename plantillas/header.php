<?php function head($title)
{

?>
        <title>GameScore | <?php echo $title; ?></title>
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <header>
        <span id="derecha">
                <a href="Index.php">
                <img class="logo" src="images/Logo.png" alt="Logo GameScore">
                </a>
            </span>
            
            <span class="align-items-center" id="izquierda">

                <nav>
                    <ul>
                        <li><a href="index.php"><strong>Inicio</strong></a></li>
                        <li><a href="nosotros.php"><strong>Sobre nosotros</strong></a></li>
                        <li><a href="noticias.php"><strong>Noticias</strong></a></li>
                        <li><a href="reviews.php"><strong>Reviews</strong></a></li>
                    </ul>
                </nav>

            </span>

            


        </header>



    <?php

}

    ?>