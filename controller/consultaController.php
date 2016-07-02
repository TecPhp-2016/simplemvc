<?php

Class consultaController Extends baseController {

	public function index() {
		$model = new ConsultaModel($this->registry);

		$usuarios = $model->getConsultas();

		$this->registry->template->usuarios = $usuarios;

		$this->registry->template->show('consulta/index');
	}

}
