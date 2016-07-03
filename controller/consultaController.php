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

	public function save() {
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

                $mensaje = new mensajeModel($this->registry);
                $ok = $mensaje->save($_POST);

                if ($ok){
                    $mensajeData = $mensaje->getById($ok);

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

}