<?php require('views/header.php');
require('views/header/header_administrador.php');?>
<h1>Roles</h1>
    <?php if(isset($mensaje)):$app->alerta($tipo,$mensaje);endif; ?>
    <a href="rol.php?accion=crear" class="btn btn-outline-success">Nuevo</a>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Rol</th>
      <th scope="col">Privilegios/Permisos</th>
      <th scope="col">Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($roles as $rol): ?>
    <tr>
      <th scope="row"><?php echo $rol ['id_rol'];?></th>
      <td><?php echo $rol ['rol'];?></td>
      <td><?php echo $app -> read_permisos($rol['id_rol']);?></td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <a href="rol.php?accion=modificar&id=<?php echo $rol ['id_rol'];?>" class="btn btn-outline-warning">Actualizar</a>
        <a href="rol.php?accion=eliminar&id=<?php echo $rol ['id_rol'];?>" class="btn btn-outline-danger">Eliminar</a>
        </div>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php require('views/footer.php'); ?>