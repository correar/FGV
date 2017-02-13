<?php
class Report_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getall_report()
	{
		$this->db->select('idpedido, dataPedido, horaPedido, enderecoEntrega.logradouro, enderecoEntrega.numero, enderecoEntrega.bairro, pedido.observacao as observacao, fkUser, user.nome, iditem, perfil.nome as perfil, centrocusto, quantidade, tipo.nome as tipo, formato.nome as formato, gramatura.nome as gramatura, coloracao.nome as coloracao, lado.nome as lado, arquivo');
		$this->db->from('item_info');
		$this->db->where('fkItem = iditem');
		$this->db->join('pedido','fkPedido_idpedido = idpedido');
		$this->db->join('item','fkPedido = idpedido');
		$this->db->join('user','fkUser = iduser');
		$this->db->join('enderecoEntrega','fkEnderecoEntrega = idenderecoEntrega');
		$this->db->join('perfil','fkPerfil = idperfil');
		$this->db->join('tipo','fkTipo = idtipo');
		$this->db->join('formato','fkFormato = idformato');
		$this->db->join('gramatura','fkGramatura = idgramatura');
		$this->db->join('coloracao','fkColoracao = idcoloracao');
		$this->db->join('lado','fkLado = idlado');
		$this->db->order_by('idpedido','DESC');
		if($query = $this->db->get()){  
			return $query->result_array();
			
		}else{
			return  $this->db->error();
			
		}
	}
}