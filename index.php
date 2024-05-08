<!DOCTYPE html>
<html>

    <?php
        require("plantillas/header.php");
        require("plantillas/footer.php");

        head("Inicio");
    ?>
    <main>
        <section id="recientes">
            <h3>Recientes</h3>
            <article>
                <p><strong>Like a dragon: Gaiden</strong> es uno de los juegos más esperados de Ryu ga Gotoku. Saldrá el
                    mes
                    de noviembre y aquí tendrás todos los datos que se saben sobre él</p><img src="images/Gaiden.jpg"
                    class="principal"><br>
                    
            </article>
            <article>
                <p><strong>Tales of Arise</strong>, el JRPG de Bandai Namco, recibirá una nueva expansión que amplía la
                    historia ya contada
                    y saldrá el 9 de noviembre</p><img src="images/Tales.jpg" class="principal">
            </article>
        </section>
        <section id="recomendaciones">
            <h3>Recomendaciones</h3>
            <article>
                <p><strong>Assassin's Creed Mirage</strong>, la nueva entrega de Ubisoft, ha adelantado su fecha de
                    lanzamiento</p>
                <img src="images/Mirage.jpg" class="principal">
            </article>
            <article>
                <p><strong>Lies of P</strong>, el aclamado soulslike, ya ha salido a la venta. También disponible en
                    Xbox
                    Game Pass. Puedes conocer nuestra
                    opinión aquí</p>
                <img src="images/Liesofp.jpg" class="principal">
            </article>
        </section>
    </main>

    <?php
        footer();
    ?>

</body>

</html>