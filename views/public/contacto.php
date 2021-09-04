<main class="int-contacto contenedor contenido-centrado">
    <h1>Contacto</h1>

    <?php if($form_res == 0): ?>
        <div class="admin-msg admin-msg-error">
            <p>Hubo un error al enviar el formulario</p>
        </div>
    <?php elseif($form_res == 1): ?>
        <div class="admin-msg admin-msg-success">
            <p>Formulario enviado correctamente</p>
        </div>
    <?php endif; ?>

    <picture>
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="imagen contacto">
    </picture>

    <h2>Rellene el formulario</h2>
    <p>Todos los campos son obligatorios</p>
    <form class="formulario" action="/contacto" method="POST" novalidate>
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Nombre" id="nombre" name="contacto[nombre]" autocomplete="off" required>

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" placeholder="Mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre propiedad</legend>
            
            <label for="compra-vende">Vende o compra</label>
            <select id="compra-vende" name="contacto[compra-vende]" required>
                <option value="" selected disabled>-- Seleccionar --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o presupuesto</label>
            <input type="number" id="presupuesto" name="contacto[presupuesto]" autocomplete="off" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <label>Medio de contacto</label>
            <select name="contacto[medio]" id="contacto-medio" required>
                <option value="telefono" selected>Teléfono</option>
                <option value="email">e-mail</option>
            </select>

            <!-- Telefono -->
            <div class="contacto-telefono">
                <label for="telefono">Teléfono</label>
                <input type="tel" placeholder="" id="telefono" name="contacto[telefono]">

                <label for="fecha">Fecha</label> 
                <input type="date" min="<?php echo date("Y-m-d"); ?>" id="fecha" name="contacto[fecha]" required>

                <label for="hora">Hora</label> 
                <input type="time" min="08:00" max="19:59" id="hora" name="contacto[hora]" required>
            </div>
            
            <!-- email -->
            <div class="contacto-email display-none">
                <label for="email">e-mail</label>
                <input type="email" placeholder="example@email.com" id="email" name="contacto[email]" required>
            </div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>