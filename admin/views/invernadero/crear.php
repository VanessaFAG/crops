<?php require('views/header.php'); ?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Invernadero</h1>

<form method="post" 
action="invernadero.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="exampleInvernadero" class="form-label">Nombre del Invernadero</label>
    <input type="text" name="data[invernadero]" placeholder="Escribe aqui el nombre" class="form-control" 
    value="<?php if(isset($invernaderos['invernadero'])):echo($invernaderos['invernadero']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleInvernadero" class="form-label">Área (m<sub>2</sub>)</label>
    <input type="number" name="data[area]" placeholder="Escribe aqui el área" class="form-control" 
    value="<?php if(isset($invernaderos['area'])):echo($invernaderos['area']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleInvernadero" class="form-label">Latitud del Invernadero</label>
    <input type="text" name="data[latitud]" placeholder="Escribe aqui la latutud" class="form-control"
    value="<?php if(isset($invernaderos['latitud'])):echo($invernaderos['latitud']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleInvernadero" class="form-label">Longitud del Invernadero</label>
    <input type="text" name="data[longitud]" placeholder="Escribe aqui la longitud" class="form-control"
    value="<?php if(isset($invernaderos['longitud'])):echo($invernaderos['longitud']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleInvernadero" class="form-label">Fecha de creación</label>
    <input type="date" name="data[fecha_creacion]" placeholder="Escribe aqui la fecha" class="form-control"
    value="<?php if(isset($invernaderos['fecha_creacion'])):echo($invernaderos['fecha_creacion']);endif;?>" />
</div>

    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>