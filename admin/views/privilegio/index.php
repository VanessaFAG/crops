<?php require('views/header.php');
require('views/header/header_administrador.php');?>
    <h1>Privilegios/Permisos</h1>
    <?php if(isset($mensaje)):$app->alerta($tipo,$mensaje);endif; ?>
    <a href="privilegio.php?accion=crear" class="btn btn-outline-success">Nuevo</a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Privilegio/Permiso</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($privilegios as $privilegio): ?>
    <tr>
      <th scope="row"><?php echo $privilegio ['id_permiso'];?></th>
      <td><?php echo $privilegio ['permiso'];?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <a href="privilegio.php?accion=modificar&id=<?php echo $privilegio ['id_permiso'];?>" class="btn btn-outline-warning">Actualizar</a>
        <a href="privilegio.php?accion=eliminar&id=<?php echo $privilegio ['id_permiso'];?>" class="btn btn-outline-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>