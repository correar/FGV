<?php
class Order_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_profile($profile)
	{
		$this->db->select('perfil.*, idtipo, tipo.nome as tipo, idgramatura, gramatura.nome as gramatura, idcoloracao, coloracao.nome as coloracao, idformato, formato.nome as formato, idlado, lado.nome as lado');
		$this->db->from('perfil');
		$this->db->where('perfil.nome',$profile);
		$this->db->join('perfil_has_tipo', 'idperfil = Perfil_idperfil');
		$this->db->join('tipo', 'idtipo = Tipo_idtipo');
		$this->db->join('gramatura', 'fkGramatura = idgramatura');
		$this->db->join('coloracao','fkColoracao = idcoloracao');
		$this->db->join('formato','fkFormato = idformato');
		$this->db->join('lado','fkLado = idlado');
		if($query = $this->db->get()){  
			return $query->result_array();
			
		}else{
			return  $this->db->error();
			
		}
		
		
	}
	
	public function getall_endereco()
	{
		$query = $this->db->get('enderecoEntrega');
		return $query->result_array();
	}
	
	public function get_endereco($idEndereco){
		$query = $this->db->get_where('enderecoEntrega',array('idenderecoEntrega'=>$idEndereco));
		return $query->result_array();
	}
	
	public function getlast_pedido()
	{
		$this->db->select_max('idpedido');
		if($query = $this->db->get('pedido')){  
			return $query->result_array();
			
		}else{
			return  $this->db->error();
			
		}
		
	}
	
	public function getlast_item()
	{
		$this->db->select_max('iditem');
		if($query = $this->db->get('item')){  
			return $query->result_array();
			
		}else{
			return  $this->db->error();
			
		}
	}

	public function set_form($data)
	{
		foreach($data as $info){
			$profile = $info['idProfile'];
			$total = $info['total'];
			
			$pedido = array(
				'dataPedido' => date('Y-m-d'),
				'horaPedido' => date('H:i:s'),
				'identificacao' => '',
				'dataEntrega' => '',
				'observacao' => $info['observacao'],
				'fkEnderecoEntrega' => $info['endereco'],
				'fkUser' => $this->session->iduser
			);
			$this->db->insert('pedido', $pedido);
			foreach($this->getlast_pedido() as $key=>$value){				
				foreach($value as $a=>$b){
					$lastPedido = $b;
				}
			}
			$item = array(
				'ordem' => '0',
				'fkPerfil' => $profile,
				'fkPedido' => $lastPedido,
				'centrocusto' => $info['centroCusto'],
				'quantidade' => $info['quantidade'],
				'observacao' => '',
				
			);
			$this->db->insert('item', $item);
			foreach($this->getlast_item() as $key=>$value){				
				foreach($value as $a=>$b){
					$lastItem = $b;
				}
			}
			for($i=1;$i<=$total;$i++){
				$tipo = $info['tipo'.$i];
				$idtipo = $info['idtipo'.$i];
				$item_info = array(
					'fkItem' => $lastItem,
					'fkPerfil_idperfil' => $profile,
					'fkPedido_idpedido' => $lastPedido,
					'fkTipo' => $idtipo,
					'fkGramatura' => $info['idgramatura'.$i],
					'fkColoracao' => $info['idcoloracao'.$i],
					'fkFormato' => $info['idformato'.$i],
					'fkLado' => $info['idlado'.$i],
					'arquivo' => $info['arquivo'.$profile.$tipo.$i.$i]
					
				);
				$this->db->insert('item_info', $item_info);
				
			}
			
		}
		return $lastPedido;
	
	}
	
	
}
?>