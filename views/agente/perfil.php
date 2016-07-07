<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?= empty($user['imagen'])?'/uploads/nop.png':'/uploads/'.$user['imagen']?>" alt="User profile picture">

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
					<form class="form-horizontal" action="/agente/perfil" method="POST"  enctype="multipart/form-data">	  
			            <div class="form-group">
				            <div class="input-group">
				                <span class="input-group-addon"><i class="fa fa-user"></i></span>
				                <input name="nombre" type="text" class="form-control" value="<?= $user['nombre']; ?>" placeholder="<?= $user['nombre']; ?>">
				              </div>
			          	</div>  
						<div class="form-group">
						<label for="exampleInputFile">Imagen</label>
                    	<input name="imagen" type="file" id="exampleInputFile" onchange="readURL(this);" style="cursor:pointer;opacity: 0;width: 100px;height: 100px;position: absolute;margin-top: 0px;">
                    		<img src="<?php echo'/uploads/'.(empty($user['imagen'])?'nop.png':$user['imagen'])?>" id="preview-profile" style="display:block;width: 100px;height: 100px;"/>
                    		<p class="help-block">Selecciona una foto de perfil del usuario</p>
		              	</div>
						<div class="form-group">
		                	<input name="update" type="hidden">
							<input name="id" type="hidden" value="<?= $user['id'];?>">
							<label for="delete">Delete</label>	
							<input type="checkbox" id="delete" name="delete"/>
							<label for="block">Block</label>
							<input type="checkbox" id="block" name="bloqueado" value="<?php echo $user['bloqueado']?>" <?php echo ($user['bloqueado'] === 1?'checked':'')?>/>
							<button type="submit" class="btn btn-info pull-right">Actualizar</button>
		              	</div>
		      		</form>
				</div>
            </div>
            <!-- /.box-body -->
      	</div>
      	 <script>
      function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                document.getElementById('preview-profile').setAttribute('src', e.target.result); 
            }

            reader.readAsDataURL(input.files[0]);
        }
      }
    </script>
		<!-- /.box -->
	</div>
</div>