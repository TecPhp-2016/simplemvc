<?php

Class consultaController Extends baseController {

	public function index() {
		$model = new ConsultaModel($this->registry);

		$datos = $model->getAll();

		$this->registry->template->datos = $datos;

		$this->registry->template->show('consulta/index');
	}

	public function atender($params = array()) {
		$model = new ConsultaModel($this->registry);

		$datos = $model->getById($params['id']);

		$this->registry->template->datos = $datos;

		$this->registry->template->show('consulta/atender');
	}

}