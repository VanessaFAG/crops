<?php require('views/header.php'); 
require('views/header/header_administrador.php');?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Privilegio/Permiso</h1>

<form method="post" 
action="privilegio.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="examplePrivilegio" class="form-label">Nombre del privilegio</label>
    <input type="text" name="data[permiso]" placeholder="Escribe aqui el nombre" class="form-control" 
    value="<?php if(isset($privilegios['permiso'])):echo($privilegios['permiso']);endif;?>" />
</div>

    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"/>
</form>
<?php require('views/footer.php');?>