<?php require('views/header.php'); ?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Sección</h1>

<form method="post" 
action="seccion.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="exampleSeccion" class="form-label">Nombre de la sección</label>
    <input type="text" name="data[seccion]" placeholder="Escribe aquí el nombre" class="form-control" 
    value="<?php if(isset($secciones['seccion'])):echo($secciones['seccion']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleSeccion" class="form-label">Área (m<sub>2</sub>)</label>
    <input type="text" name="data[area]" placeholder="Escribe aquí el área" class="form-control" 
    value="<?php if(isset($secciones['area'])):echo($secciones['area']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleSeccion" class="form-label">Id del Invernadero</label>
    <input type="text" name="data[id_invernadero]" placeholder="Escribe el id del invernadero" class="form-control"
    value="<?php if(isset($secciones['id_invernadero'])):echo($secciones['id_invernadero']);endif;?>"/>
</div>

<div class="mb-3">
    <label for="">Invernadero</label>
    <select name="data[id_invernadero]" id="" class="form-select form-select-sm" aria-label="Small select example">
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
</select>

</div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>