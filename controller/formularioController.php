<?php

Class formularioController Extends baseController {

	public function form() {
		$model = new FormularioModel($this->registry);

		$datos = $model->getAll();

		$this->registry->template->datos = $datos;

		$this->registry->template->show('formulario/index');
	}

}