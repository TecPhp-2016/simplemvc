<?php

class agenteController Extends baseController {
	private function saveImage($username){
		$this->verificarUsuario();

		$target_dir = getcwd()."\uploads\\";
		$target_file = $target_dir . $username;
		$uploadOk = 1;
		$imageFileType = pathinfo(basename($_FILES["imagen"]["name"]),PATHINFO_EXTENSION);
		$target_file = $target_file.".".$imageFileType;
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
		    if($check !== false) {
		        echo "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        echo "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    unlink($target_file);
		}
		// Check file size
		if ($_FILES["imagen"]["size"] > 50000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
		return $username.'.'.$imageFileType;
	}
	
	public function index(){
		$this->verificarUsuario();

		$model = new AgenteModel($this->registry);

		$usuarios = $model->getAll();

		$this->registry->template->usuarios = $usuarios;

		$this->registry->template->show('agente/index');
	}

	public function disponible(){
		$this->verificarUsuario();

		if(isset($_POST["update"])){
			$usuario = $_SESSION['agente'];
			$model = new AgenteModel($this->registry, $usuario["id"]);
			$usuarios = $model->getAll();
			$usuario['no_disponible'] = $usuario['no_disponible'] == 0 ? 1 : 0;
			
			$_SESSION['agente'] = $usuario;
			unset($usuario["id"]);
			$model->update($usuario);
			
			$this->registry->template->usuarios = $usuarios;
			$this->registry->template->show('agente/index');
		}else{
			$usuario = $_SESSION['agente'];
			$this->registry->template->usuario = $usuario;
			$this->registry->template->show('agente/disponible');
		}
	}

	public function perfil($params=array()){
		$this->verificarUsuario();

		$model = new AgenteModel($this->registry);
		if(isset($params["id"])){
			$datos = $model->getById($params["id"]);
			$this->registry->template->user = $datos;
			$this->registry->template->show('agente/perfil');
		}else if (!isset($_POST['update'])){
			$user = $model->getById($_SESSION['agente']["id"]);
			$this->registry->template->user = $user;
			$this->registry->template->show('agente/perfil');
		}else{
			$user = new AgenteModel($this->registry, $_POST["id"]);
			if(isset($_POST['delete'])){
				unset($_POST['delete']);
				$user->delete();
				$usuarios = $user->getAll();
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('agente/index');
				return;
			}
			unset($_POST['update']);
			$userLogged = $user->getById($_POST['id']);
			unset($_POST['id']);
			
			$_POST['bloqueado'] = false;
			if(isset($_POST['bloqueado'])){
				$_POST['bloqueado'] = true;	
			}else{
				$_POST['bloqueado'] = false;	
			}

			if(!empty($_FILES["imagen"]["tmp_name"])){
 				$_POST['imagen'] = $this->saveImage($userLogged["email"]);
			}

			$insertOk = $user->update($_POST);
			if ($insertOk){
				if($_SESSION['agente']['id'] == $userLogged['id']){
					$_SESSION['agente']['nombre'] = $_POST['nombre'];
					header("Location: http://localhost:8888/agente");
					die();
				}
				
				$usuarios = $user->getAll();
				$this->registry->template->usuarios = $usuarios;
				$this->registry->template->show('agente/index');
			}else{
				$this->registry->template->blog_heading = 'Error al guardar los datos';
				$this->registry->template->error = 'No se pudo guardar';
				$this->registry->template->show('error404');
			}
		}
	}

	public function save(){
		$this->verificarUsuario();

		if (isset($_POST['enviar'])){
			$model = new AgenteModel($this->registry);
	        
	        unset($_POST['enviar']);
	        if(!empty($_FILES["imagen"] ["tmp_name"])){

 				$_POST['imagen'] = $this->saveImage($_POST["email"]);
			}
			$insertOk = $model->save($_POST);

			if ($insertOk){
				
				$usuarios = $model->getAll();
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
		$this->verificarUsuario();

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
			$user = new AgenteModel($this->registry, $_POST["id"]);

			unset($_POST['update']);
			unset($_POST['id']);
			if(!empty($_FILES["imagen"] ["tmp_name"])){
 				$_POST['imagen'] = $_POST['imagen'] = $this->saveImage($userLogged["email"]);
	        }
	        $insertOk = $user->update($_POST);
			
			if ($insertOk){

				$usuarios = $user->getAll();

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
		$this->verificarUsuario();

		$model = new AgenteModel($this->registry);
                
		$usuarios = $model->getAll();
		
		$this->registry->template->usuarios = $usuarios;
		$this->registry->template->show('agente/all');
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
