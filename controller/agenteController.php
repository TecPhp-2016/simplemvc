<?php

Class agenteController Extends baseController {
	private function saveImage($username){
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
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["imagen"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			 move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file) or die();
	}
	public function index(){
		$model = new AgenteModel($this->registry);

		$usuarios = $model->getAll();

		$this->registry->template->usuarios = $usuarios;

		$this->registry->template->show('agente/index');
	}

	public function perfil($params=array()){
		if (!isset($_POST['update'])){
			$model = new AgenteModel($this->registry);

			$user = $model->getById($_SESSION['agente']["id"]);

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
				
				$usuarios = $model->getAll();
				$this->saveImage($_POST["username"]);
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
			$user = new AgenteModel($this->registry, $_POST["id"]);

			unset($_POST['update']);
			unset($_POST['id']);
	        
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
		$model = new AgenteModel($this->registry);
                
		$usuarios = $model->getAll();
		
		$this->registry->template->usuarios = $usuarios;
		$this->registry->template->show('agente/all');

	}


}
