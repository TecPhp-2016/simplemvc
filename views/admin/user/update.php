<div class="row">
	<div class="col-md-6">
		<!-- general form elements -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Editar Usuario</h3>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form role="form" action="../../mvc/user/update" method="POST">
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Usuario</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Enter username" value="<?php echo $user->getName(); ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" value="<?php echo $user->getPassword(); ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputFile">Edad</label>
						<input type="text" class="form-control" name="age" id="age" placeholder="Enter username" value="<?php echo $user->getAge(); ?>">
						<p class="help-block">Ingrese su edad actual</p>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox"> Recordarme
						</label>
					</div>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
					<input type="hidden" name="id" value="<?php echo $user->getId(); ?>" />
					<button type="submit" name="update" class="btn btn-primary">Guardar</button>
				</div>

			</form>
		</div>
		<!-- /.box -->
	</div>
</div>