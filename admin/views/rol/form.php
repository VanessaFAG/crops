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

<div class="mb-3">
    <label for="exampleRol" class="form-label">Privilegios/Permisos</label>
    <?php foreach($privilegios as $privilegio): ?>
        <div class="form-check">
            <input type="checkbox" name="data[privilegios][]" 
            value="<?php echo $privilegio['id_permiso'];?>" name ="data[privilegio][]"
            <?php echo in_array($privilegio['id_permiso'], $privilegiosRolID)?"checked":"";?>>
            <label class="form-check-label" for="exampleCheck1">
                <?php echo($privilegio['permiso']);?>
            </label>
        </div>
    <?php endforeach;?>

</div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>