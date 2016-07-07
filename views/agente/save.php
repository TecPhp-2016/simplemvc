<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Crear agente</h3>
  </div>

  <div class="box-body">
  	<form class="form-horizontal" action="/agente/save" method="POST" enctype="multipart/form-data">
      <div class="box-body">
        <div class="form-group col-md-12"> 
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon">@</span>
                <input name="username" type="text" class="form-control" placeholder="Usuario">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input name="email" type="email" class="form-control" placeholder="Email">
              </div>
          </div>
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input name="nombre" type="text" class="form-control" placeholder="Nombre">
              </div>
          </div>
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input name="clave" type="password" class="form-control" placeholder="Clave">
              </div>
          </div>
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar-minus-o"></i></span>
                <input name="jornada_laboral" type="text" class="form-control" placeholder="Jornada Laboral">
              </div>
          </div>
          <div class="form-group">
                    <label for="exampleInputFile">Imagen</label>
                    <input name="imagen" type="file" id="exampleInputFile" onchange="readURL(this);" style="cursor:pointer;opacity: 0;width: 100px;height: 100px;position: absolute;margin-top: 0px;">
                    <img src="https://s-media-cache-ak0.pinimg.com/736x/d4/45/20/d4452035f501e05adf90c63af107bb1a.jpg" id="preview-profile" style="display:block;width: 100px;height: 100px;"/>
                    <p class="help-block">Selecciona una foto de perfil del usuario</p>
                  </div>
          <div class="form-group">
            <div class="checkbox">
                <label>
                  <input name="admin" value="1" type="checkbox">
                  Admin
                </label>
              </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
                <label>
                  <input name="bloqueado" value="1" type="checkbox">
                  Bloqueado
                </label>
              </div>
          </div>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <input name="enviar" type="hidden">
        <button type="submit" class="btn btn-info pull-right">Guardar Agente</button>
      </div>
      <!-- /.box-footer -->
    </form>
  	<!-- /.box-body -->
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
	</div>
</div>