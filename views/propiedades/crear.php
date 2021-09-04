<main class="contenedor seccion">
    <h1>Crear nueva propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <!-- Mensajes de error -->
    <?php if(!empty($errores)): ?>
        <div class="admin-msg admin-msg-error">
            <?php foreach($errores as $error): ?>
                <p>&sdot; <?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>


    <!-- Formulario -->
    <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . "/_form.php" ?>

            <input type="submit" value="Crear propiedad" class="boton-verde">
        </form>
</main>