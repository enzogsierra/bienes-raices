<h2>Casas y departamentos en venta</h2>  

<?php if(empty($propiedades)): ?>
    <p>Aún no hay casas y departamentos en ventas</p>
<?php else: ?>
    <div class="anuncios">
        <?php foreach($propiedades as $propiedad): ?>
            <div class="anuncio" data-cy="anuncio">
                <a data-cy="anuncio-link" href="/anuncio?id=<?php echo $propiedad->id?>" class="anuncio-link"></a>

                <img class="anuncio-img" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="propiedad" loading="lazy">
                
                <div class="anuncio-contenido">
                    <div>
                        <h4><?php echo (strlen($propiedad->titulo) < 32) ? ($propiedad->titulo): (substr($propiedad->titulo, 0, 32) . "..."); ?></h4>
                        <p class="anuncio-contenido__precio">&dollar;<?php echo number_format($propiedad->precio, 0, ','); ?></p>
                        <p><?php echo (strlen($propiedad->descripcion) < 144) ? ($propiedad->descripcion): (substr($propiedad->descripcion, 0, 144) . "..."); ?></p>
                    </div>

                    <ul class="anuncio-icons">
                        <li>
                            <img src="build/img/icono_wc.svg" alt="icon wc" loading="lazy">
                            <p><?php echo $propiedad->wc; ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_estacionamiento.svg" alt="icon estacionamiento" loading="lazy">
                            <p><?php echo $propiedad->estacionamiento; ?></p>
                        </li>
                        <li>
                            <img src="build/img/icono_dormitorio.svg" alt="icon habitaciones" loading="lazy">
                            <p><?php echo $propiedad->habitaciones; ?></p>
                        </li>
                    </ul>
                </div>
            </div> 
        <?php endforeach;?>
    </div>
<?php endif; ?>

<?php if(isset($limit)): ?>
    <div class="anuncio-vertodas">
        <a href="/anuncios" class="boton-verde" data-cy="btn-vertodas">ver todas</a>
    </div>
<?php endif; ?>