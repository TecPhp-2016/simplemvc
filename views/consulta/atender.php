<?php 
  $usuario = $_SESSION['agente'];
?>
<div class="box box-default direct-chat direct-chat-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Consulta</h3>
  </div>
  <div class="box-body">

  <div class="direct-chat-messages" id="direct-chat-messages" style="height:350px;">

  </div>

  </div>
  <!-- /.box-body -->
  <div class="box-footer">
    <div class="input-group">
      <input type="text" id="message" placeholder="Responder..." class="form-control">
        <span class="input-group-btn">
          <input type="hidden" id="autor" value="<?= $usuario['nombre']?>" />
          <input type="hidden" id="consulta_id" value="<?= $datos['id']?>"/>
          <button type="button" onClick="enviarMensaje()" class="btn btn-primary btn-flat">Enviar</button>
        </span>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<script>
  $( document ).ready(function() {
    var pusher  = new Pusher('bfe07b86fb5d707a3087', { encrypted: true });
    var channel = pusher.subscribe('consulta-' + <?= $datos['id']?>);
    channel.bind('mensaje', function(data) {
      if (data.autor == 'usuario'){
        var imagen = 'http://localhost:8888/vendor/almasaeed2010/adminlte/dist/img/avatar04.png';
        mostrarMensaje(data.autor, data.mensaje, data.fecha, imagen);
      }
    });
  });

  $('#message').keypress(function( event ) {
    if ( event.which == 13 ) {
      enviarMensaje();
      event.preventDefault();
    }
  });

  function enviarMensaje(){
    var autor       = $('#autor').val();
    var consulta_id = $('#consulta_id').val();
    var message     = $('#message').val();
    var fecha       = new Date();

    $.ajax({
      method  : 'POST',
      url     : 'http://localhost:8888/consulta/mensajeSave?ajax=true',
      data    : { consulta_id: consulta_id, autor : 'agente', mensaje : message, enviar : true}
    })
    .done(function( result ) {
      if (result.success){
        var imagen = '<?='/uploads/'. empty($usuario['imagen'])?'nop.png':$usuario['imagen'] ?>';
        mostrarMensaje(autor, message, fecha, imagen, true)
      }
    });
  }

  function mostrarMensaje(autor, message, fecha, imagen, agente){
    $('#message').val('');

    if(agente){
      var html =  '<div class="direct-chat-msg right">' +
                  '<div class="direct-chat-info clearfix">' +
                    '<span class="direct-chat-name pull-right">' + autor + '</span>' +
                    '<span class="direct-chat-timestamp pull-left">' + fecha + '</span>' +
                  '</div>' +
                  '<img class="direct-chat-img" src="' + imagen + '">' +
                  '<div class="direct-chat-text">' + message + '</div>' +
                '</div>';
    }else{
      var html =  '<div class="direct-chat-msg">' +
                  '<div class="direct-chat-info clearfix">' +
                    '<span class="direct-chat-name pull-left">' + autor + '</span>' +
                    '<span class="direct-chat-timestamp pull-right">' + fecha + '</span>' +
                  '</div>' +
                  '<img class="direct-chat-img" src="' + imagen + '">' +
                  '<div class="direct-chat-text">' + message + '</div>' +
                '</div>';
    }

    $('#direct-chat-messages').append(html);

    $('#direct-chat-messages').scrollTop($('#direct-chat-messages')[0].scrollHeight);
  }
</script>