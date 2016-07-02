<?php
class agenteModel extends AbstractModel{
    private $table_name = 'agentes';

    protected $id;
    protected $nombre = '';
    protected $username = '';
    protected $clave = '';
    
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

    public function getUsuarios(){
		$agentes = $this->registry->db->get($this->table_name);
		return $agentes;
	}

	public function getUsuario($id){
        $agente = $this->registry->db->where('id',$id)->getOne($this->table_name);

        return $agente;
    }

    public function login($username, $clave){
        $query = "SELECT * from agentes where username = ? and clave = SHA1('" . $clave . "+salt" . "')";
        $agente = $this->registry->db->rawQuery($query, Array ($username));
		
		return $agente;
	}

	public function save($datos){
		$datos['clave'] = $this->registry->db->func('SHA1(?)',Array ($datos['clave'] . "+salt"));
		$resultado = $this->registry->db->insert($this->table_name, $datos);

        if ($resultado){
          //Send notification to anyone who want to know
          // Ok, user is created, tell anyone who's interested
            \simple_event_dispatcher\Events::trigger('user', 'create', [
                'username' => $datos['username']
            ]);
        }
        
		return $resultado;
	}

	public function delete(){
		return $this->registry->db->where('id', $this->getId())->delete($this->table_name);
	}

	public function update($datos){
		return $this->registry->db->where('id', $this->getId())->update($this->table_name, $datos);
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