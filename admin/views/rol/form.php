<?php require('views/header.php');
require('views/header/header_administrador.php');
$privilegio_rol = $app -> get_Permiso_Rol($id);
$privilegiosRolID = array_column($privilegio_rol,'id_permiso')?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Rol</h1>

<form method="post" 
action="rol.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="exampleRol" class="form-label">Nombre del rol</label>
    <input type="text" name="data[rol]" placeholder="Escribe aquí el nombre" class="form-control" 
    value="<?php if(isset($roles['rol'])):echo($roles['rol']);endif;?>" />
</div>

<p class="fs-5">Privilegios/Permisos del rol.</p>
<div class="privilegios">
    <?php foreach ($privilegios as $privilegio) :?>
    <div class="form-check form-switch">
        <input name="permiso[]" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" value="<?php echo $privilegio['id_permiso']; ?>">
        <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo $privilegio['permiso']; ?></label>
    </div>
    <?php endforeach; ?>
</div>

    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>