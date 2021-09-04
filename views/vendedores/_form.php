<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre</label>  
    <input name="vendedor[nombre]" type="text" placeholder="Nombre" id="nombre" value="<?php echo s($vendedor->nombre); ?>" required>

    <label for="apellido">Apellido</label>  
    <input name="vendedor[apellido]" type="text" placeholder="Apellido" id="apellido" value="<?php echo s($vendedor->apellido); ?>" required>

    <label for="telefono">Teléfono</label>  
    <input name="vendedor[telefono]" type="text" placeholder="Teléfono" id="telefono" value="<?php echo s($vendedor->telefono); ?>" required>
</fieldset>