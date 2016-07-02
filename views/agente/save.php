<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Crear agente</h3>
  </div>
  <div class="box-body">
  	<form class="form-horizontal" action="/agente/save" method="POST">
      <div class="box-body">
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>

          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Asunto</label>

          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputAsunto" placeholder="Asunto">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Consulta</label>

          <div class="col-sm-10">
            <textarea type="text" class="form-control" id="inputConsulta" placeholder="Consulta"></textarea>
          </div>
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        
        <button type="submit" class="btn btn-info pull-right">Enviar Consulta</button>
      </div>
      <!-- /.box-footer -->
    </form>
  	<!-- /.box-body -->
	</div>
</div>