<?php require('views/header.php'); ?>
<h1><?php if($accion == "crear"): echo('Nuevo'); else: echo ('Actualizar'); endif;?> Sección</h1>

<form method="post" 
action="seccion.php?accion=<?php if($accion == "crear"):echo('nuevo'); else:echo('actualizar&id='.$id);endif;?>">
<div class="mb-3">
    <label for="exampleSeccion" class="form-label">Nombre de la sección</label>
    <input type="text" name="data[seccion]" placeholder="Escribe aqui el nombre" class="form-control" 
    value="<?php if(isset($secciones['seccion'])):echo($secciones['seccion']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleSeccion" class="form-label">Área (m<sub>2</sub>)</label>
    <input type="text" name="data[area]" placeholder="Escribe aqui el área" class="form-control" 
    value="<?php if(isset($secciones['area'])):echo($secciones['area']);endif;?>" />
</div>

<div class="mb-3">
    <label for="exampleSeccion" class="form-label">Id del Invernaderó</label>
    <input type="text" name="data[id_invernadero]" placeholder="Escribe el id del invernadero" class="form-control"
    value="<?php if(isset($secciones['id_invernadero'])):echo($secciones['id_invernadero']);endif;?>" />
</div>

    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>