<?php

class userModel extends AbstractModel{
    private $table_name = 'usuarios';
    protected $id;
    protected $name='';
    protected $password='';
    protected $age = 0;
    
    public function __construct($registry, $id=null){
    	parent::__construct($registry);

    	if (!is_null($id)){
    		$datos = $this->getUsuario($id);
    		$this->fromArray($datos);
    	}
    }

    public function getUsuarios(){
		$usuarios = $this->registry->db->get($this->table_name);
		return $usuarios;
	}

	public function getUsuario($id){
		$usuario = $this->registry->db->where('id',$id)->getOne($this->table_name);

		return $usuario;
	}

	public function save($datos){
		$datos['password'] = $this->registry->db->func('SHA1(?)',Array ($datos['password']."+salt"));
		$resultado = $this->registry->db->insert($this->table_name, $datos);

		return $resultado;
	}

	public function delete($id){
		return $this->registry->db
					->where('id', $id)
					->delete($this->tablename);
	}

	public function update($datos){
		return $this->registry->db->where('id', $this->getId())
								  ->update($this->table_name, $datos);
	}

	/**
	 * Hace un where filtrando por las condiciones que se reciben por parametro
	 * Ej: filter(
	 * 				array('name'=>array('=','Luis'),
	 * 				    'age'=>array('>',10)
	 *         	       )
	 *           )
	 * @param  [array] $conditions Condiciones con clave la columna
	 * @return [array] Resultado de la consulta 
	 */
	public function filter($conditions){
		
		foreach ($conditions as $column => $operadorValor) {
			foreach ($operadorValor as $operador => $valor) {
				$this->registry->db->where($column, $valor, $operador);
			}
		}

		return $this->registry->db->get($this->table_name);
		
	}
        

}


?>