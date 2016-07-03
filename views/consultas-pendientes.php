<div class="box">
    <div class="box-header">
      <h3 class="box-title">Consultas Pendientes</h3>
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
          <td>Pendiente</td>
          <td><?= $consulta['creado']; ?></td>
          <td>
            <a href="consulta/atender?id=<?= $consulta['id']; ?>" class="btn btn-sm btn-flat bg-olive"><i class="fa fa-commenting-o"></i></a>
          </td>
        </tr>
        <?php } ?>
      </table>
    </div>
    <!-- /.box-body -->
    </div>

    