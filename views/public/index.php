<main class="contenedor main">
    <h2 data-cy="heading-nosotros">Más sobre nosotros</h2>

    <?php include "_iconos.php"; ?>
</main>

<section class="seccion contenedor">       
    <?php
        include "_anuncios.php";
    ?>
</section>


<!-- CONTACTO -->
<section class="contacto" data-cy="contacto">
    <h2>Encuentra la casa de tus sueños</h2>
    <p>Rellena el formulario de contacto y un asesor se pondrá en contacto contigo</p>
    <a href="contacto.php" class="boton-naranja">Contacto</a>
</section>


<!-- BLOG -->
<div class="contenedor seccion-blog">
    <section class="blog">
        <h3>Nuestro blog</h3>

        <article class="blog-entrada">
            <div class="blog-entrada__imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpg" type="image/jpeg">
                    <img src="build/img/blog1.jpg" alt="imagen blog 1" loading="lazy">
                </picture>
            </div>
            <div class="blog-entrada__texto">
                <a href="entrada.php">
                    <h4>Terraza en el techo de tu casa</h4>
                    <p class="informacion-meta">Escrito el <span>20/10/2021</span> por <span>Admin</span></p>
                    <p>Consejos para construir una terraza en el techo de tu casa, con los mejores materiales y ahorrando dinero</p>
                </a>
            </div>
        </article>

        <article class="blog-entrada">
            <div class="blog-entrada__imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <source srcset="build/img/blog2.jpg" type="image/jpeg">
                    <img src="build/img/blog2.jpg" alt="imagen blog 2" loading="lazy">
                </picture>
            </div>
            <div class="blog-entrada__texto">
                <a href="entrada.php">
                    <h4>Guía para la decoración de tu hogar</h4>
                    <p class="informacion-meta">Escrito el <span>24/10/2021</span> por <span>Admin</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                </a>
            </div>
        </article>
    </section>

    <section class="blog-testimoniales">
        <h3>Testimoniales</h3>

        <div class="blog-testimonial">
            <blockquote>
                El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas!
            </blockquote>
            <p>- Enzo Sierra</p>
        </div>
    </section>
</div>
