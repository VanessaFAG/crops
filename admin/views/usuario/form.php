<?php require('views/header.php');
require('views/header/header_administrador.php');?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Usuario</h1>

<form method="post" 
action="usuario.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="exampleUsuario" class="form-label">Correo del usuario</label>
    <input type="text" name="data[correo]" placeholder="Escribe aquí el correo" class="form-control" 
    value="<?php if(isset($usuarios['correo'])):echo($usuarios['correo']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleUsuario" class="form-label">Contraseña</label>
    <input type="password" name="data[password]" placeholder="Escribe aquí la constraseña" class="form-control" 
    value="<?php if(isset($usuarios['password'])):echo($usuarios['password']);endif;?>" />
</div>
<p class="fs-5">Rol del usuario</p>
<div class="roles">
    <?php foreach ($roles as $rol) :?>
    <div class="form-check form-switch">
        <input name="rol[]" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="<?php echo $rol['id_rol']; ?>">
        <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $rol['rol']; ?></label>
    </div>
    <?php endforeach; ?>
</div>

</div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>