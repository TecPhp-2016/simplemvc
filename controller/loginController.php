<?php

Class loginController Extends baseController {

	public function index(){
		if (isset($_POST['enviar'])){
			$agente = new AgenteModel($this->registry);

			$loginOk = $agente->login($_POST['username'], $_POST['clave']);

			if ($loginOk){
				$_SESSION['agente'] = current($loginOk);

				header("Location: http://localhost:8888");
				die();
			}else{
				$this->registry->template->error = 'Usuario o clave incorrectos. Contactese con un agente administrador porque puede ser que usted este bloqueado';
				$this->registry->template->show('/login');
			}
		}else{
			$this->registry->template->error = '';
			$this->registry->template->show('login');
		}
	}

	public function salir(){
		unset($_SESSION['agente']);
		header("Location: http://localhost:8888");
		die();
	}
}
