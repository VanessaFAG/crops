<?php require('views/header.php');
require('views/header/header_administrador.php');?>
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
    <label for="">Invernadero</label>
    <select name="data[id_invernadero]" id="" class="form-select form-select-sm" aria-label="Small select example">
    <option>Invernaderos disponibles</option>
        <?php foreach($invernaderos as $invernadero):?>
        <?php 
        $selecionar = "";
        if($secciones['id_invernadero'] == $invernadero['id_invernadero']){
            $selecionar = "selected";
        }        
        ?>
        <option value="<?php echo($invernadero['id_invernadero']);?>"<?php echo($selecionar);?>><?php echo($invernadero['invernadero']);?></option>
        <?php endforeach;?>
</select>

</div>
    <input type="submit" name="data[enviar]" value="Guardar" class="btn btn-outline-info"
    />
</form>
<?php require('views/footer.php');?>