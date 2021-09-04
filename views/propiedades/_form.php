<fieldset>
    <legend>Información general</legend>
    <label for="titulo">Título</label>  
    <input name="propiedad[titulo]" type="text" placeholder="Nombre de la propiedad" id="titulo" value="<?php echo s($propiedad->titulo); ?>">
    
    <label for="precio">Precio</label> 
    <input name="propiedad[precio]" type="number" placeholder="0" id="precio" value="<?php echo s($propiedad->precio); ?>" autocomplete="off">
    
    <label for="imagen">Imagen</label>  
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
    <?php if($propiedad->imagen): ?>
        <div class="formulario-imagen">
            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="propiedad">
            <p>(Imagen actual)</p>
        </div>
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Habitaciones</label> 
    <input name="propiedad[habitaciones]" type="number" placeholder="0" id="habitaciones" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>" autocomplete="off">

    <label for="wc">Baños</label> 
    <input name="propiedad[wc]" type="number" placeholder="0" id="wc" min="1" max="9" value="<?php echo s($propiedad->wc); ?>" autocomplete="off">

    <label for="estacionamiento">Estacionamientos</label> 
    <input name="propiedad[estacionamiento]" type="number" placeholder="0" id="estacionamiento" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>" autocomplete="off">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <select name="propiedad[vendedorId]">
        <option value="" disabled selected>-- Selecciona un vendedor --</option>

        <?php foreach($vendedores as $vendedor): ?>
            <option value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?></option>
        <?php endforeach; ?>
        <!-- <option value="" -->
    </select>
</fieldset>