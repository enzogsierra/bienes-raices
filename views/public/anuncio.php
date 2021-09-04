<main class="contenedor anuncio-single contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>

    <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="imagen propiedad">
    
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

    <p class="anuncio-single__precio">&dollar;<?php echo number_format($propiedad->precio, 0, ','); ?></p>
    <p><?php echo $propiedad->descripcion ?></p>
</main>
