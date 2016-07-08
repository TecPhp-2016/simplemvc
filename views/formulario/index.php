<div class="box">
  <div class="box-header">
    <h3 class="box-title">Formularios</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-condensed">
      <tr>
        <th style="width: 10px">#</th>
        <th>Creado</th>
        <th>Correo</th>
        <th>Asunto</th>
        <th>Consulta</th>
      </tr>
      <?php foreach ($datos as $key => $formularios) {
        $linkToEdit = '/agente/update?id=' . $formularios['id'];
      ?>
      <tr>
        <td><?= $formularios['id']; ?></td>
        <td><?= $formularios['creado']; ?></td>
        <td><?= $formularios['correo']; ?></td>
        <td><?= $formularios['asunto']; ?></td>
        <td><?= $formularios['consulta']; ?></td>
      </tr>
      <?php } ?>
    </table>
  </div>
  <!-- /.box-body -->
</div>