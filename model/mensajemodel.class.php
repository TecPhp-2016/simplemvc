<?php
class mensajeModel extends AbstractModel{
    private $table_name = 'mensajes';

    protected $id;
    protected $consulta_id;
    protected $autor = '';
    protected $mensaje = '';
    protected $fecha = '';
    
    public function __construct($registry, $id = null){
    	parent::__construct($registry);

    	if (!is_null($id)){
    		try {
              $datos = $this->getUsuario($id);
              if ($datos){
                $this->fromArray($datos);
              }
            } catch (Exception $e) {
              return false;
            } 
    	}
    }

    public function getAll(){
		$data = $this->registry->db->get($this->table_name);
		return $data;
	}

    public function getAllByCase($id_consulta){
        $data = $this->registry->db->where('consulta_id',$id_consulta)->get($this->table_name);
        return $data;
    }

	public function getById($id){
        $data = $this->registry->db->where('id',$id)->getOne($this->table_name);

        return $data;
    }

	public function save($datos){
		$resultado = $this->registry->db->insert($this->table_name, $datos);
        
		return $resultado;
	}

	public function delete(){
		return $this->registry->db->where('id', $this->getId())->delete($this->table_name);
	}

	public function update($datos){
		return $this->registry->db->where('id', $this->getId())->update($this->table_name, $datos);
	}
}