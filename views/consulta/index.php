<div class="box">
  <div class="box-header">
    <h3 class="box-title">Consultas</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tr>
        <th style="width: 10px">#</th>
        <th>Agente</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Acciones</th>
      </tr>
      <?php 
        foreach ($datos as $key => $consulta) {
      ?>
      <tr>
        <td><?= $consulta['id']; ?></td>
        <td><?= $consulta['agente_id']; ?></td>
        <td><?= $consulta['estado']; ?></td>
        <td><?= $consulta['creado']; ?></td>
        <td>
          <a href="consulta/atender?id=<?= $consulta['id']; ?>" class="btn btn-sm btn-flat bg-primary"><i class="fa fa-search"></i></a>
        </td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <!-- /.box-body -->
</div>
