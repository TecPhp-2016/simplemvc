
									



<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listado de Agentes</h3>
              <a class="pull-right btn btn-primary btn-flat" href="agente/save" class="uppercase">Agregar Agente</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Tipo</th>
                  <th>Disponible</th>
                  <th>ND Desde</th>
                  <th>Jornada Laboral</th>
                </tr>
                
                <?php
				foreach ($usuarios as $key => $usuario) {
					$linkToEdit = '/agente/update?id=' . $usuario['id'];
				?>
				<tr>
					<td class="chat"><div class="item"><img src="<?php echo $usuario['imagen']; ?>" alt="user image" class="<?php if ($usuario['online'] == 1) { ?>online<?php } else { ?>offline<?php } ?>"></div></td>
					<td><?php echo $usuario['username']; ?></td>
					<td><?php echo $usuario['nombre']; ?></td>
					<td><?php echo $usuario['email']; ?></td>
					<td><?php if ($usuario['admin'] == 1) { ?> <span class="label label-warning">Admin</span> <?php } else { ?> <span class="label label-primary">Agente</span> <?php } ?> </td>
					<td><?php if ($usuario['bloqueado'] == 1) { ?> <span class="label label-danger">Bloqueado</span> <?php } else { ?> <span class="label label-success">Activo</span> <?php } ?> </td>
					<td><?php echo $usuario['no_disponible_fecha']; ?></td> 
					<td><?php echo $usuario['jornada_laboral']; ?></td>  	


					</tr>
				<?php } ?>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>