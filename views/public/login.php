<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar sesión</h1>

    <!-- Mensajes de error -->
    <?php if(!empty($errores)): ?>
        <div class="admin-msg admin-msg-error">
            <?php foreach($errores as $error): ?>
                <p>&sdot; <?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form class="formulario" method="POST" action="/login">
        <fieldset>
            <legend>Credenciales</legend>
            <label for="user">Usuario</label>           
            <input type="text" placeholder="" name="user" id="user" required>

            <label for="password">Contraseña</label>  
            <input type="password" name="password" id="password" required>
        </fieldset>

        <input type="submit" value="Iniciar sesión" class="boton boton-verde">
    </form>
</main>