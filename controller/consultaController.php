<?php

class consultaController Extends baseController {

	public function index() {
        $this->verificarUsuario();

		$model = new ConsultaModel($this->registry);
        if($_SESSION['agente']['admin']){
            $datos = $model->getAll();
        }else{
            $datos = $model->getAllMine($_SESSION['agente']['id']);
        }

		$this->registry->template->datos = $datos;
		$this->registry->template->show('consulta/index');
	}

	public function atender($params = array()) {
		$model = new ConsultaModel($this->registry, $params['id']);
		$datos = $model->getById($params['id']);
        if($datos['agente_id'] == null){
            $datosa['agente_id'] = $_SESSION['agente']['id'];
            $datosa['estado'] = 'atendida';
            $model->update($datosa);
        }  
        $datos = $model->getById($params['id']);
        $this->registry->template->datos = $datos;

        $modelConsulta = new MensajeModel($this->registry);
        $datosConsulta = $modelConsulta->getAllByCase($params['id']);
        $this->registry->template->datosConsulta = $datosConsulta;

        $modelAgente = new AgenteModel($this->registry);
        $datosAgente = $modelAgente->getById($datos['agente_id']);
        $this->registry->template->datosAgente = $datosAgente;

        $this->registry->template->show('consulta/atender');
	}

	public function save() {
        $this->verificarUsuario();

        if (isset($_POST['enviar'])){
            try {
                unset($_POST['enviar']);

                $consulta = new ConsultaModel($this->registry);
                $data['usuario'] = $_POST['usuario'];
                $data['estado'] = 'pendiente';
                $consultaSave = $consulta->save($data);

                if ($consultaSave){
                    $mensaje = new mensajeModel($this->registry);

                    $dataM['mensaje'] = $_POST['consulta'];
                    $dataM['consulta_id'] = $consultaSave;
                    $dataM['autor'] = $_POST['usuario'];

                    $ok = $mensaje->save($dataM);

                    if ($ok){
                        $resultado = array(
                            'success' => true,
                            'consulta' => json_encode($consultaSave),
                        );
                    }else{
                        $resultado = array(
                            'success' => false,
                            'msg' => 'No se pudo guardar la consulta.',
                        );
                    }
                }else{
                    $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo guardar la consulta.',
                    );
                }
            } catch (Exception $e) {
              $resultado = array(
                    'success' => false,
                    'msg' => $e->getMessage(),
                );
            }

            echo json_encode($resultado);
        } else {
            $this->registry->template->error = 'No existe la ruta';
            $this->registry->template->show('error404');
        }
    }

    public function mensajeSave() {
        if (isset($_POST['enviar'])){
            try {
                unset($_POST['enviar']);

                $options = array(
                    'encrypted' => true
                );
                
                $pusher = new Pusher(
                    'bfe07b86fb5d707a3087',
                    '57196882cfaf2db7480d',
                    '222185',
                    $options
                );

                $consultaId = $_POST['consulta_id'];

                $model = new ConsultaModel($this->registry);
                $consulta = $model->getById($consultaId);

                $mensaje = new mensajeModel($this->registry);
                $ok = $mensaje->save($_POST);

                if ($ok){
                    $mensajeData = $mensaje->getById($ok);

                    if($_POST['autor'] == "agente"){
                        $mensajeData['imagen'] = "/uploads/" . $_SESSION['agente']['imagen'];
                        $mensajeData['autor'] = $_SESSION['agente']['nombre'];
                    }else{
                        $mensajeData['autor'] = $consulta['usuario'];
                    }

                    $pusher->trigger('consulta-' . $consultaId, 'mensaje', $mensajeData);

                    $resultado = array(
                        'success' => true
                    );
                }else{
                    $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo guardar la consulta.',
                    );
                }

            } catch (Exception $e) {
              $resultado = array(
                    'success' => false,
                    'msg' => $e->getMessage(),
                );
            }

            echo json_encode($resultado);
        } else {
            $this->registry->template->error = 'No existe la ruta';
            $this->registry->template->show('error404');
        }
    }

    public function terminar() {
        $this->verificarUsuario();

        if (isset($_POST['enviar'])){
            try {
                unset($_POST['enviar']);

                $model = new ConsultaModel($this->registry,$_POST['id']);
                $ok = $model->update($_POST);

                $resultado = array(
                    'success' => true
                );

            } catch (Exception $e) {
              $resultado = array(
                    'success' => false,
                    'msg' => $e->getMessage(),
                );
            }

            echo json_encode($resultado);
        } else {
            $this->registry->template->error = 'No existe la ruta';
            $this->registry->template->show('error404');
        }
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