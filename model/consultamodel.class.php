<?php

class consultaModel extends AbstractModel{
    private $table_name = 'consultas';

    protected $id;
    protected $agente_id;
    protected $estado = '';
    protected $usuario = '';
    protected $creado = '';
    
    public function __construct($registry, $id = null){
    	parent::__construct($registry);

    	if (!is_null($id)){
    		try {
              $datos = $this->getById($id);
              if ($datos){
                $this->fromArray($datos);
              }
            } catch (Exception $e) {
              return false;
            } 
    	}
    }

    public function getAll(){
		$data = $this->registry->db->where('estado', 'pendiente', '!=')->get($this->table_name);
		return $data;
	}

    public function getAllPendientes(){
        $data = $this->registry->db->where('estado', 'pendiente')->get($this->table_name);
        return $data;
    }

    public function getAllMine($id){
        $data = $this->registry->db->where('estado', 'finalizada','!=')->where('agente_id', $id)->get($this->table_name);
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