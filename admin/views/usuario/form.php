<?php require('views/header.php');
require('views/header/header_administrador.php');?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Sección</h1>

<form method="post" 
action="usuario.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="exampleUsuario" class="form-label">Correo del usuario</label>
    <input type="text" name="data[correo]" placeholder="Escribe aquí el correo" class="form-control" 
    value="<?php if(isset($usuarioes['correo'])):echo($usuarioes['correo']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleUsuario" class="form-label">Contraseña</label>
    <input type="text" name="data[password]" placeholder="Escribe aquí la constraseña" class="form-control" 
    value="<?php if(isset($usuarioes['password'])):echo($usuarioes['password']);endif;?>" />
</div>

<div class="mb-3">
    <label for="">Rol</label>
    <select name="data[id_rol]" id="" class="form-select form-select-sm" aria-label="Small select example">
    <option>Roles disponibles</option>
        <?php foreach($roles as $rol):?>
        <?php 
        $selecionar = "";
        if($usuarioes['id_rol'] == $rol['id_rol']){
            $selecionar = "selected";
        }        
        ?>
        <option value="<?php echo($rol['id_rol']);?>"<?php echo($selecionar);?>><?php echo($role['rol']);?></option>
        <?php endforeach;?>
</select>

</div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>