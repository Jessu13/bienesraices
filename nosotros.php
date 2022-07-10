<?php 

    require 'includes/funciones.php';
    incluirTemplate('header');

?>

    <main class="contenedor seccion">
        <h1>Conoce sobre Nosotros</h1>

        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>
                    25 Años de experiencia
                </blockquote>

                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius, facere. Atque reprehenderit, aliquid quia assumenda nobis commodi, excepturi quidem illum vel ipsum eum. At beatae maxime voluptatibus architecto, veniam repellendus?
                </p>

                <p>
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore autem sit maiores unde nostrum eligendi eveniet delectus atque doloremque! Aut, at. Culpa, maiores asperiores quod quidem vero quibusdam ducimus officia?
                </p>
            </div>
        </div>
    </main>

    <section class="contenedor seccion">
        <h1>Más Sobre Nosotros</h1>

        <div class="iconos-nosotros">
            <div class="icono">
                <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum modi sequi nesciunt alias aperiam earum ab id, totam, consectetur quam soluta maiores. Ad, officia pariatur vitae odio sint numquam reiciendis?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum modi sequi nesciunt alias aperiam earum ab id, totam, consectetur quam soluta maiores. Ad, officia pariatur vitae odio sint numquam reiciendis?</p>
            </div>

            <div class="icono">
                <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
                <h3>A Tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum modi sequi nesciunt alias aperiam earum ab id, totam, consectetur quam soluta maiores. Ad, officia pariatur vitae odio sint numquam reiciendis?</p>
            </div>
        </div>
    </section>

<?php 
    incluirTemplate('footer');
?>


    <script src="build/js/bundle.min.js"></script>
</body>
</html>