<?php

Class indexController Extends baseController {

	public function index() {
		if ($_SESSION && $_SESSION['agente']){
			$this->registry->template->show('consultas-activa');
		}else{
			$this->registry->template->mensajeForm = '';
			$this->registry->template->show('index');
		}
	}

	public function formulario(){
		if (isset($_POST['enviar'])){
			$model = new formularioModel($this->registry);
	        
	        unset($_POST['enviar']);


			$insertOk = $model->save($_POST);

			if ($insertOk){
				$this->registry->template->mensajeForm = 'Mensaje enviado, nuestros agentes se contactaran con usted a la brevedad';
				$this->registry->template->show('index');

			}else{
				$this->registry->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}
		}

	}

}
