<?php

Class agenteController Extends baseController {

	public function index() {
		/*** set a template variable ***/
	        $this->registry->template->welcome = 'User controller index';
		/*** load the index template ***/
	        $this->registry->template->show('agente/index');
	}

	//Llamada de ejemplo http://localhost/mvc/agente/all?ajax=1&order=desc
	// public function all($params=array()){
	// 	$model = new AgenteModel($this->registry);
                
	// 	$usuarios = $model->getUsuarios();
		
	// 	if (isset($params['ajax'])){
	// 		echo json_encode($usuarios);
	// 	}else{
	// 		$this->registry->template->usuarios = $usuarios;
	// 		$this->registry->template->show('agente/all');
	// 	}

	// }
	// 
	
	public function all(){
		$model = new AgenteModel($this->registry);

		$usuarios = $model->getUsuarios();

		$this->registry->template->usuarios = $usuarios;

		$this->registry->template->show('agente/all');
	}

	public function save(){
		if (isset($_POST['enviar'])){

			$model = new AgenteModel($this->registry);
	        
	        unset($_POST['enviar']);
	        unset($_POST['id']);

			$insertOk = $model->save($_POST);

			if ($insertOk){

				$usuarios = $model->getUsuarios();
				
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('agente/all');

			}else{
				$this->registry->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}
		}else{
			$this->registry->template->show('agente/save');
		}

	}

	public function update($params=array()){
		if (!isset($_POST['update'])){
		
			if (isset($params["id"])){
				$user = new AgenteModel($this->registry, $params["id"]);
			}else{
				$user = new AgenteModel($this->registry);
			}
			
			if (isset($params['ajax'])){
				echo json_encode($user->toArray());
			}else{
				$this->registry->template->user = $user;
				$this->registry->template->show('agente/update');
			}
		}else{
			//var_dump($_POST);die;
			$user = new AgenteModel($this->registry, $_POST["id"]);

			unset($_POST['update']);
			unset($_POST['id']);
	        
			$insertOk = $user->update($_POST);

			if ($insertOk){

				$usuarios = $user->getUsuarios();
				
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('agente/all');

			}else{
				$this->registry->template->blog_heading = 'Error al guardar los datos';
				$this->registry->template->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}

		}

	}

	public function login(){
		if (isset($_POST['Login'])){
			//Logica del login
			$user = new AgenteModel($this->registry);
			$loginOk = $user->login($_POST['username'], $_POST['password']);

			if ($loginOk){
				echo "Bienvenido ". $_POST['username'];
			}else{
				echo "Usuario o password invalidos";
			}
		}else{
			//Muestro el formulario
			$this->registry->template->show('agente/login');
		}
	}

	public function delete(){
		$model = new AgenteModel($this->registry);
                
		$usuarios = $model->getUsuarios();
		
		$this->registry->template->usuarios = $usuarios;
		$this->registry->template->show('agente/all');

	}


}
