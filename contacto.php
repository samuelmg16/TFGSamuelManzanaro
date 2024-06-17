<!DOCTYPE html>
<html lang="es">

<?php

require_once "plantillas/modales.php";
require_once "plantillas/header.php";
require_once "plantillas/footer.php";

head("Contacto");
?>
<main>
        <section id="contacto">
            <h2>Contacto</h2>
            <form id="formContacto" method="post">
                <?php
                if(isset($_SESSION['username'])){
                    ?>
                    <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['username'] ?>">
                    <?php
                } else {
                    ?>
                    <input type="hidden" id="username" name="username" value="Usuario no registrado">
                    <?php
                }
                
                ?>
                <label for="from_name">Nombre:</label>
                <input type="text" id="from_name" name="from_name" required>

                <label for="user_email">Email:</label>
                <input type="email" id="user_email" name="user_email" required>

                <label for="message">Mensaje:</label>
                <textarea id="message" name="message" rows="5" required></textarea>

                <button type="submit">Enviar</button>
            </form>
            <div id="result"></div>
        </section>
    </main>
<?php
modalIniciarSesion();
modalRegistroUsuario();
footer();
?>
<script src="js/enviarEmail.js"></script>
</body>

</html>