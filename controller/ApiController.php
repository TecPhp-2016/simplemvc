<?php

Class apiController Extends baseController {

public function index(){

}

public function deleteUser() {
  if (isset($_POST['id'])){
    $id = $_POST['id'];

    try {
      $userToDelete = new UserModel($this->registry, $id);
      $ok = $userToDelete->delete();
      
      if ($ok){
        $resultado = array(
                        'success' => true,
                        'msg' => 'Usuario borrado exitosamente.',
                    );
      }else{
        $resultado = array(
                        'success' => false,
                        'msg' => 'No se pudo borrar el usuario.',
                    );
      }    
      
    } catch (Exception $e) {
      $resultado = array(
            'success' => false,
            'msg' => $e->getMessage(),
        );
    }
  }else{
    $resultado = array(
          'success' => false,
          'msg' => 'Falta parametro id.',
      );
  }

  echo json_encode($resultado);
}

}

?>