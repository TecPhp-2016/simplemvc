<?php

Class agenteController Extends baseController {

	
	public function index(){
		$model = new AgenteModel($this->registry);

		$usuarios = $model->getUsuarios();

		$this->registry->template->usuarios = $usuarios;

		$this->registry->template->show('agente/index');
	}

	public function perfil($params=array()){
		if (!isset($_POST['update'])){
			$agenteLogueado = $_SESSION ? $_SESSION['agente'] : null;

			$model = new AgenteModel($this->registry);

			$user = $model->getUsuario($agenteLogueado["id"]);

			$this->registry->template->user = $user;

			$this->registry->template->show('agente/perfil');
		}else{
			//var_dump($_POST);die;
			$user = new AgenteModel($this->registry, $_POST["id"]);

			unset($_POST['update']);
			unset($_POST['id']);
	        
			$insertOk = $user->update($_POST);
			
			if ($insertOk){
				$_SESSION['agente']['nombre'] = $_POST['nombre'];

				header("Location: http://localhost:8888");
				die();
			}else{
				$this->registry->template->blog_heading = 'Error al guardar los datos';
				$this->registry->template->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}

		}
	}

	public function save(){
		if (isset($_POST['enviar'])){
			$model = new AgenteModel($this->registry);
	        
	        unset($_POST['enviar']);


			$insertOk = $model->save($_POST);

			if ($insertOk){
				$usuarios = $model->getUsuarios();
				
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('agente/index');

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
				
				$agenteLogueado = $_SESSION ? $_SESSION['agente'] : null;
				$agenteLogueado['nombre'] = $_POST['nombre'];
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('agente/index');

			}else{
				$this->registry->template->blog_heading = 'Error al guardar los datos';
				$this->registry->template->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}

		}
	}

	public function delete(){
		$model = new AgenteModel($this->registry);
                
		$usuarios = $model->getUsuarios();
		
		$this->registry->template->usuarios = $usuarios;
		$this->registry->template->show('agente/all');

	}


}
