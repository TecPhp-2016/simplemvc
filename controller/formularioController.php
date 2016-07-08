<?php

class formularioController Extends baseController {

	public function form() {
		$this->verificarUsuario();

		$model = new FormularioModel($this->registry);

		$datos = $model->getAll();

		$this->registry->template->datos = $datos;

		$this->registry->template->show('formulario/index');
	}

	public function index(){
		$this->verificarUsuario();

		$model = new FormularioModel($this->registry);

		$datos = $model->getAll();

		$this->registry->template->datos = $datos;

		$this->registry->template->show('formulario/index');
	}

	private function verificarUsuario (){
        $agenteLogueado = $_SESSION ? $_SESSION['agente'] : false;
        if(!$agenteLogueado){
            $this->registry->template->blog_heading = 'Error al guardar los datos';
            $this->registry->template->error = 'No se pudo guardar';
            $this->registry->template->show('error404');
            die();
        }
    }

}