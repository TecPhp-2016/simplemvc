<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-body box-profile">
            <form class="form-horizontal" action="/agente/disponible" method="POST">
            	 <span class="input-group-addon">Desea cambiar su disponibilidad?</span>
        		<button type="submit" class="btn btn-info pull-right">
        			<?php echo ($usuario['no_disponible'] == 0 ?'No Disponible': 'Disponible');?>
        			<?php echo $usuario['no_disponible'];?>
    			</button>
    			<input type="hidden" name="update"/>
            </div>
	    </div>
    </div>
</div>	