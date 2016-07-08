<?php

class loginController Extends baseController {

	public function index(){
		if (isset($_POST['enviar'])){
			$agente = new AgenteModel($this->registry);

			$loginOk = $agente->login($_POST['username'], $_POST['clave']);

			if ($loginOk){
				$_SESSION['agente'] = current($loginOk);

				$user = new AgenteModel($this->registry, $_SESSION['agente']["id"]);

				$user->update(['online' => 1]);

				header("Location: http://localhost:8888"); die();
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
		if($_SESSION && $_SESSION['agente']){
			$user = new AgenteModel($this->registry, $_SESSION['agente']["id"]);
			$user->update(['online' => 0]);

			unset($_SESSION['agente']);	
		}

		$this->registry->template->mensajeForm = '';
        $this->registry->template->show('index');
	}
}
