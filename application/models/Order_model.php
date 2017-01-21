<?php
class Order_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_profile($profile)
	{
		$this->db->select('perfil.*, tipo.nome as tipo, gramatura.nome as gramatura, coloracao.nome as coloracao, formato.nome as formato, lado.nome as lado');
		$this->db->from('perfil');
		$this->db->where('perfil.nome',$profile);
		$this->db->join('perfil_has_tipo', 'idperfil = Perfil_idperfil');
		$this->db->join('tipo', 'idtipo = Tipo_idtipo');
		$this->db->join('gramatura', 'fkGramatura = idgramatura');
		$this->db->join('coloracao','fkColoracao = idcoloracao');
		$this->db->join('formato','fkFormato = idformato');
		$this->db->join('lado','fkLado = idlado');
		$query = $this->db->get();  
		return $query->result_array();
		
	}
	
	
}
?>