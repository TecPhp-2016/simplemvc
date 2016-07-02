<?php

Class indexController Extends baseController {

	public function index() {
		if ($_SESSION && $_SESSION['agente']){
			$this->registry->template->show('index-agente');
		}else{
			$this->registry->template->show('index');
		}
	}

}
