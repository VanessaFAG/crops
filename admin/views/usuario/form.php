<?php require('views/header.php');
require('views/header/header_administrador.php');?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Usuario</h1>

<form method="post" 
action="usuario.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="correo" class="form-label">Correo del usuario</label>
    <input id="correo" type="text" name="data[correo]" placeholder="Escribe aquí el correo" class="form-control" 
    value="<?php if(isset($usuarios['correo'])):echo($usuarios['correo']);endif;?>" />
</div>

<div class="mb-3">
    <label for="password" class="form-label">Contraseña</label>
    <input id="password" type="password" name="data[password]" placeholder="Escribe aquí la constraseña" class="form-control" 
    value="<?php if(isset($usuarios['password'])):echo($usuarios['password']);endif;?>" disabled>
    <div class="row">
    <div class="col-2">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="resetPassword">
            <label class="form-check-label" for="resetPassword">Modificar contraseña</label>
        </div>
    </div>
    <div class="col-2">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="showPassword">
            <label class="form-check-label" for="showPassword">Mostrar contraseña</label>
        </div>
    </div>
    </div>
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
<script src="../js/formScript.js"></script>
<?php require('views/footer.php');?>