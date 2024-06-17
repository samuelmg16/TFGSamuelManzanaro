<!DOCTYPE html>
<html lang="es">
    <?php
    
    require_once "plantillas/modales.php";
    require_once "plantillas/header.php";
    head("Sobre Nosotros");
    ?>
    <?php require_once "plantillas/footer.php"; ?>

    <main>
        <section class="about-us">
            <h1>Sobre Nosotros</h1>
            <p>Bienvenido a GameScore, tu fuente principal para las últimas noticias y reviews de videojuegos. En GameScore, estamos apasionados por el mundo de los videojuegos y nos dedicamos a brindar a nuestra audiencia información precisa y detallada sobre los juegos más recientes y esperados del mercado.</p>
            <p>Nuestra comunidad está formada por entusiastas de los videojuegos con años de experiencia en la industria. Nos esforzamos por proporcionar contenido de alta calidad que sea útil tanto para jugadores casuales como para aficionados acérrimos.</p>
            <p>En GameScore encontrarás:</p>
            <ul>
                <li><strong>Noticias de última hora:</strong> Mantente al día con las novedades más recientes del mundo de los videojuegos.</li>
                <li><strong>Reviews detalladas:</strong> Lee nuestras opiniones y análisis exhaustivos sobre los últimos lanzamientos.</li>
                <li><strong>Comentarios en artículos:</strong> Únete a nuestra comunidad y comparte tus experiencias y opiniones con otros jugadores.</li>
                <li><strong>Puntúa comentarios:</strong> ¿Crees que ha sido útil? ¡Pulgar arriba! Ayuda a los comentarios más interesantes a llegar a una mayor audiencia.</li>
            </ul>
            <p>Nos encanta recibir comentarios y sugerencias de nuestros lectores. Si tienes alguna pregunta, comentario o simplemente quieres ponerte en contacto con nosotros, no dudes en enviarnos un mensaje a través de nuestra <a href="contacto.php">página de contacto.</a></p>
            <p>¡Gracias por visitarnos y ser parte de la comunidad de GameScore! Esperamos que disfrutes de nuestro contenido y que encuentres toda la información que necesitas para disfrutar al máximo de tus juegos favoritos.</p>
        </section>
    </main>

    <?php 
    modalIniciarSesion();
    modalRegistroUsuario();
    footer(); 
    ?>
</body>
</html>
