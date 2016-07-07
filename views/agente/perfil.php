<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= getcwd().'\uploads\\'.empty($user['imagen'])?'nop.png':$user['imagen']?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?= $user['nombre']; ?></h3>

              <p class="text-muted text-center"><?= $user['username']; ?></p>

				<ul class="list-group list-group-unbordered">
					<li class="list-group-item">
						<b>Email</b> <a class="pull-right"><?= $user['email']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Jornada Laboral</b> <a class="pull-right"><?= $user['jornada_laboral']; ?></a>
					</li>
					<li class="list-group-item">
						<b>Tipo</b>
						<a class="pull-right">
							<?php if ($user['admin'] == 1) { ?><span class="label label-warning">Admin</span> <?php } else { ?> <span class="label label-primary">Agente</span> <?php } ?>
						</a>
					</li>
				</ul>
				<div class="col-md-12">
					<form class="form-horizontal" action="/agente/perfil" method="POST">	  
			            <div class="form-group">
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <input name="nombre" type="text" class="form-control" value="<?= $user['nombre']; ?>" placeholder="<?= $user['nombre']; ?>">
				              </div>
			          	</div>  
						<div class="form-group">
		                	<label for="exampleInputFile">Nueva Imagen</label>
		                	<input name="imagen" type="file" id="exampleInputFile" value="<?php= '/uploads/'.empty($user['imagen'])?'nop.png':$user['imagen']?>">
		              	</div>
						<div class="form-group">
		                	<input name="update" type="hidden">
							<input name="id" type="hidden" value="<?= $user['id'];?>">
							<button type="submit" class="btn btn-info pull-right">Actualizar</button>
		              	</div>
		      		</form>
				</div>
            </div>
            <!-- /.box-body -->
      	</div>
		<!-- /.box -->
	</div>
</div>