<?php if (isset($agentes) && count($agentes) > 0) {?>
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title"><b><?= count($agentes)?></b> Agentes disponibles</h3>
  </div>
  <div class="box-body">
  	<div class="row">
	   <div class="col-md-12">
	    <div class="col-md-8">    
		    <div class="row">
		    	<ul class="users-list clearfix">
          <?php 
            foreach ($agentes as $key => $agente) {
          ?>
            <li>
              <img src="<?=empty($agente['imagen'])?'/uploads/nop.png':'/uploads/'.$agente['imagen']?>">
              <a class="users-list-name" style="font-size: 11px;"><?= $agente['nombre']; ?></a>
            </li> 
          <?php } ?>
	     		</ul>
	    	</div>
	    </div>
	    <div class="col-md-4">
        <div class="row">
          <div class="col-md-12" id="consulta">
            <div class="box box-danger box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Realizar consulta</h3>
                <p>Ingrese los datos y un agente le tomara la consulta.</p>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
                  </div>
                  <div class="form-group">
                    <label for="consulta">Consulta</label>
                    <textarea name="consulta" type="text" class="form-control" id="mensajeConsulta" placeholder="Consulta"></textarea>
                  </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                  <button type="button" onClick="crearConsulta()" class="btn btn-danger">Consultar</button>
                </div>
              </form>
            </div>
          </div>

          <!-- DIRECT CHAT PRIMARY -->
          <div class="col-md-12" id="chat" style="display:none">
            <div class="box box-primary direct-chat direct-chat-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Chat</h3>  
              </div>
              <div class="box-body">

                <div class="direct-chat-messages" id="direct-chat-messages" style="height:350px;">

                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="input-group">
                  <input type="text" id="message" placeholder="Mensaje..." class="form-control">
                    <span class="input-group-btn">
                      <input type="hidden" id="autor"/>
                      <input type="hidden" id="consulta_id"/>
                      <button type="button" onClick="enviarMensaje()" class="btn btn-primary btn-flat">Enviar</button>
                    </span>
                </div>
              </div>
              <!-- /.box-footer-->
            </div>
          </div>
          <!--/.direct-chat -->
        </div>
      </div>
  	</div>
</div>

<script>
  $('#message').keypress(function( event ) {
    if ( event.which == 13 ) {
      enviarMensaje();
      event.preventDefault();
    }
  });

  function crearConsulta(){
    var autor     = $('#nombre').val();
    var consulta  = $('#mensajeConsulta').val();

    $.ajax({
      method  : 'POST',
      url     : 'http://localhost:8888/consulta/save?ajax=true',
      data    : { usuario: autor, consulta : consulta , enviar : true}
    })
    .done(function( result ) {
      if (result.success){
        $('#consulta_id').val(result.consulta);
        $('#autor').val(autor);

        $('#consulta').fadeOut(500, function() {
          var html =  '<div class="direct-chat-msg right">' +
                        '<div class="direct-chat-info clearfix">' +
                          '<span class="direct-chat-name pull-right">' + autor + '</span>' +
                          '<span class="direct-chat-timestamp pull-left">' + moment().format('DD/MM/YY HH:mm:ss') + '</span>' +
                        '</div>' +
                        '<img class="direct-chat-img" src="http://localhost:8888/vendor/almasaeed2010/adminlte/dist/img/avatar04.png">' +
                        '<div class="direct-chat-text">' + consulta + '</div>' +
                      '</div>';

          $('#direct-chat-messages').prepend(html);

          $('#chat').fadeIn( 100 );
        });

        var pusher  = new Pusher('bfe07b86fb5d707a3087', { encrypted: true });
        var channel = pusher.subscribe('consulta-' + result.consulta);
        channel.bind('mensaje', function(data) {
          console.log(data);
          if (data.tipo != 'usuario'){
            mostrarMensaje(data.autor, data.mensaje, data.fecha, data.imagen, true);
          }
        });
      }
    });
  }

  function enviarMensaje(){
    var autor       = $('#autor').val();
    var consulta_id = $('#consulta_id').val();
    var message     = $('#message').val();
    var fecha       = moment();

    if(message){
      $.ajax({
        method  : 'POST',
        url     : 'http://localhost:8888/consulta/mensajeSave?ajax=true',
        data    : { consulta_id: consulta_id, autor : 'usuario', mensaje : message, enviar : true}
      })
      .done(function( result ) {
        if (result.success){
          var imagen = 'http://localhost:8888/vendor/almasaeed2010/adminlte/dist/img/avatar04.png';
          mostrarMensaje(autor, message, fecha, imagen)
        }
      });  
    }
  }

  function mostrarMensaje(autor, message, fecha, imagen, agente){
    $('#message').val('');
    var html = '';

    if(agente){
      html =  '<div class="direct-chat-msg">' +
                  '<div class="direct-chat-info clearfix">' +
                    '<span class="direct-chat-name pull-left">' + autor + '</span>' +
                    '<span class="direct-chat-timestamp pull-right">' + moment(fecha).format('DD/MM/YY HH:mm:ss') + '</span>' +
                  '</div>' +
                  '<img class="direct-chat-img" src="' + imagen + '">' +
                  '<div class="direct-chat-text">' + message + '</div>' +
                '</div>';
    }else{
      html =  '<div class="direct-chat-msg right">' +
                  '<div class="direct-chat-info clearfix">' +
                    '<span class="direct-chat-name pull-right">' + autor + '</span>' +
                    '<span class="direct-chat-timestamp pull-left">' + moment(fecha).format('DD/MM/YY HH:mm:ss') + '</span>' +
                  '</div>' +
                  '<img class="direct-chat-img" src="' + imagen + '">' +
                  '<div class="direct-chat-text">' + message + '</div>' +
                '</div>';
    }

    $('#direct-chat-messages').append(html);

    $('#direct-chat-messages').scrollTop($('#direct-chat-messages')[0].scrollHeight);
  }
</script>

<?php } else { ?>

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Mesa de ayuda - Consultas</h3>
  </div>
  <div class="box-body">
    <div class="pad">
      <div class="callout callout-info" style="margin-bottom: 0!important;">
        <h4><i class="fa fa-info"></i> No hay agentes disponibles</h4>
        En este momento no hay ningun agente disponible, deje un mensaje y nos comunicaremos con usted a la brevedad. Desde ya muchas gracias.
      </div>
    </div>
  </div>
</div>

<div class="box box-info">
  <form class="form-horizontal" action="index/formulario" method="POST">
    <div class="box-header with-border">
      <h3 class="box-title">Deja un mensaje</h3>
    </div>
    <div class="box-body">
      <?php if($mensajeForm) {?>
      <div class="alert alert-success alert-dismissible">
        <?php echo $mensajeForm; ?>
      </div>
      <?php }?>
    </div>
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
<?php } ?>