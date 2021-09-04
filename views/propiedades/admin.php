<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>

    <!-- -->
    <?php if($success === 0): ?>
        <div class="admin-msg admin-msg-error">
            <p>ID no válida</p>
        </div>

    <?php elseif($success === 1): ?>
        <div class="admin-msg admin-msg-success">
            <p>Creado correctamente</p>
        </div>

    <?php elseif($success === 2): ?>
        <div class="admin-msg admin-msg-success">
            <p>Actualizado correctamente</p>
        </div>

    <?php elseif($success === 3): ?>
        <div class="admin-msg admin-msg-success">
            <p>Eliminado correctamente</p>
        </div>

    <?php elseif($success === 4): ?>
        <div class="admin-msg admin-msg-success">
            <p>Error inesperado</p>
        </div>
    <?php 
        endif; 
    ?>

    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton boton-naranja">Nuevo Vendedor</a>

    <!-- LISTA PROPIEDADES  -->
    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach($propiedades as $propiedad):
            ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="propiedad-imagen"></td>
                    <td>&dollar;<?php echo $propiedad->precio; ?></td>
                    <td>
                        <div class="propiedad-icon">
                            <a href="/propiedades/editar?id=<?php echo $propiedad->id ?>">
                                <img src="/build/img/icon-edit.svg" alt="edit icon" title="Editar propiedad">    
                            </a>
                            <form method="POST" id="propiedades-formsubmit" action="/propiedades/eliminar">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="image" src="/build/img/icon-delete.svg" alt="delete icon" title="Eliminar propiedad" class="_delete-button">
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- LISTA VENDEDORES -->
    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre y apellido</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($vendedores as $vendedor): 
            ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td><a href="tel:<?php echo $vendedor->telefono; ?>" class="_vendedor-tel"><?php echo $vendedor->telefono; ?></a></td>
                    <td>
                        <div class="propiedad-icon">
                            <a href="/vendedores/editar?id=<?php echo $vendedor->id ?>">
                                <img src="/build/img/icon-edit.svg" alt="edit icon" title="Editar vendedor">    
                            </a>
                            <form method="POST" id="propiedades-formsubmit" action="/vendedores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="image" src="/build/img/icon-delete.svg" alt="delete icon" title="Eliminar vendedor" class="_delete-button">
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; 
            ?>
        </tbody>
    </table>
</main>