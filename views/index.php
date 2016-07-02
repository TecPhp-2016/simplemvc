<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title"><b>CANTIDAD</b> Agentes disponibles</h3>
  </div>
  <div class="box-body">

  	<div class="row">
	<div class="col-md-12">

	    <div class="col-md-8">    
		    <div class="row">
		    	<div class="col-md-12">
		      
					<!-- COMIENZA AGENTE DISPONIBLE -->
					<div class="col-md-6">
					<!-- Widget: user widget style 1 -->
						<div class="box box-widget widget-user">
						<!-- Add the bg color to the header using any of the bg-* classes -->
							<div class="widget-user-header bg-aqua-active">
								<h3 class="widget-user-username">Mathi De León</h3>
								<h5 class="widget-user-desc">Founder &amp; CEO</h5>
							</div>
							<div class="widget-user-image">
								<img class="img-circle" src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="User Avatar">
							</div>
						</div>
					</div>
					<!-- TERMINA AGENTE DISPONIBLE -->

	     		</div>
	    	</div>
	    </div>
	    <div class="col-md-4">
          <!-- DIRECT CHAT PRIMARY -->
          <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Realizar Consulta</h3>

              <div class="box-tools pull-right">
                <span data-toggle="tooltip" title="3 New Messages" class="badge bg-light-blue">3</span>
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages">
                <!-- Message. Default to the left -->
                <div class="direct-chat-msg">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">Nombre Agente</span>
                    <span class="direct-chat-timestamp pull-right">23 Jan 2:00 pm</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="https://almsaeedstudio.com/themes/AdminLTE/dist/img//user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    Texto Agente
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->

                <!-- Message to the right -->
                <div class="direct-chat-msg right">
                  <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-right">Nombre Cliente</span>
                    <span class="direct-chat-timestamp pull-left">23 Jan 2:05 pm</span>
                  </div>
                  <!-- /.direct-chat-info -->
                  <img class="direct-chat-img" src="https://almsaeedstudio.com/themes/AdminLTE/dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img -->
                  <div class="direct-chat-text">
                    Texto Cliente!
                  </div>
                  <!-- /.direct-chat-text -->
                </div>
                <!-- /.direct-chat-msg -->
              </div>
              <!--/.direct-chat-messages-->

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <form action="#" method="post">
                <div class="input-group">
                  <input type="text" name="message" placeholder="Escribe la Consulta..." class="form-control">
                      <span class="input-group-btn">
                        <button type="submit" class="btn btn-primary btn-flat">Consultar</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
          <!--/.direct-chat -->
        </div>

  	</div>
  	<!-- NO HAY AGENTES DISPONIBLES -->
  	<div class="col-md-12">
          <div class="box box-info">
          <?php if($mensajeForm) {?>
        <div class="alert alert-success alert-dismissible">
          <?php echo $mensajeForm; ?>
        </div>
        <?php }?>
            <div class="box-header with-border">
              <h3 class="box-title">Deja un mensaje</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="index/formularios" method="POST">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Correo</label>

                  <div class="col-sm-10">
                    <input name="correo" type="email" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Asunto</label>

                  <div class="col-sm-10">
                    <input name="asunto" type="text" class="form-control" id="inputAsunto" placeholder="Asunto">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Consulta</label>

                  <div class="col-sm-10">
                    <textarea name="consulta" type="text" class="form-control" id="inputConsulta" placeholder="Consulta"></textarea>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input name="enviar" type="hidden">
                <button type="submit" class="btn btn-info pull-right">Enviar Consulta</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
  	</div>
  <!-- /.box-body -->
</div>