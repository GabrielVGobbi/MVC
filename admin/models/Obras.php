<?php

class Obras extends model
{

	public function __construct()
	{
		parent::__construct();
		$this->array = array();
		$this->retorno = array();
	}

	//selecionar todos
	public function getAll($filtro, $id_company)
	{

		$where = $this->buildWhere($filtro, $id_company);

		$sql = "
		SELECT * FROM  
			obra obr
			INNER JOIN servico sev ON(obr.id_servico = sev.id)
			INNER JOIN cliente cle ON(cle.id = obr.id_cliente)
			INNER JOIN concessionaria con ON(con.id = obr.id_concessionaria)
			LEFT JOIN obra_etapa obtp ON (obr.id = obtp.id_obra)		
		WHERE " . implode(' AND ', $where) . " GROUP BY obr.id";

		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	public function getObraCliente($id_cliente, $filtro, $id_company)
	{

		$where = $this->buildWhere( $filtro, $id_company, $id_cliente);

		$sql = "
		SELECT * FROM  
			obra obr
			INNER JOIN servico sev ON(obr.id_servico = sev.id)
			INNER JOIN cliente cle ON(cle.id = obr.id_cliente)
			INNER JOIN concessionaria con ON(con.id = obr.id_concessionaria)
			LEFT JOIN obra_etapa obtp ON (obr.id = obtp.id_obra)		
		WHERE " . implode(' AND ', $where) . " GROUP BY obr.id";

		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	private function buildWhere($filtro, $id,$id_cliente = 0)
	{
		$where = array(
			'obr.id_company=' . $id
		);

		if($id_cliente != 0){
			$where[] = 'obr.id_cliente='. $id_cliente;
		}
		if (!empty($filtro['nome_obra'])) {

			if ($filtro['nome_obra'] != '') {

				$where[] = "obr.obr_razao_social LIKE :nome_obra";
			}
		}

		if (!empty($filtro['cliente_nome'])) {

			if ($filtro['cliente_nome'] != '') {

				$where[] = "cle.cliente_nome LIKE :cliente_nome";
			}
		}


		if (!empty($filtro['id'])) {

			if ($filtro['id'] != '') {

				$where[] = "obr.id = :id";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['nome_obra'])) {
			if ($filtro['nome_obra'] != '') {
				$sql->bindValue(":nome_obra", '%' . $filtro['nome_obra'] . '%');
			}
		}

		if (!empty($filtro['cliente_nome'])) {
			if ($filtro['cliente_nome'] != '') {
				$sql->bindValue(":cliente_nome", '%' . $filtro['cliente_nome'] . '%');
			}
		}

		if (!empty($filtro['id'])) {
			if ($filtro['id'] != '') {
				$sql->bindValue(":id", $filtro['id']);
			}
		}
	}

	//Contagem de quantos Registros
	public function getCount($id_company)
	{

		$r = 0;
		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM obra WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();
		}

		$r = $row['c'];

		return $r;
	}

	//Selecionar por ID
	public function getInfo($id, $id_company)
	{

		$array = array();

		$sql = $this->db->prepare("SELECT * FROM servico WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();


		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}

	public function delete($id, $id_company)
	{

		$sql = $this->db->prepare("DELETE FROM servico WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		if ($sql->execute()) {
			controller::alert('danger', 'servico deletado com sucesso!!');
		} else {
			controller::alert('error', 'Usuario desativado com sucesso!!');
		}
	}

	public function add($Parametros, $id_company)
	{


		$date = strftime('%d-%m-%Y', strtotime('today'));
		$data = ucwords($date);
		try {
			$sql = $this->db->prepare("INSERT INTO obra SET 
					id_company = :id_company,
					id_servico = :id_servico,
					id_cliente = :id_cliente,
					id_concessionaria = :id_concessionaria,
					obr_razao_social = :razao_social,
					data_obra 		= :data_obra

			
			");

			$sql->bindValue(":razao_social", $Parametros['obra_nome']);
			$sql->bindValue(":id_servico", $Parametros['servico']);
			$sql->bindValue(":id_cliente", $Parametros['id_cliente']);
			$sql->bindValue(":data_obra", $data);
			$sql->bindValue(":id_concessionaria", $Parametros['concessionaria']);

			$sql->bindValue(":id_company", $id_company);


			if ($sql->execute()) {
				controller::alert('success', 'Obra criado com sucesso!!');
			} else {
				controller::alert('error', 'Não foi possivel fazer o cadastro da obra, Contate o administrador do sistema!!');
			}

			$id_obra = $this->db->lastInsertId();

			$this->servico = new Servicos();
			$etapas = $this->servico->getEtapas($Parametros['concessionaria'], $Parametros['servico']);

			if (isset($etapas)) {
				if (count($etapas) > 0) {
					for ($q = 0; $q < count($etapas); $q++) {

						$sql = $this->db->prepare("INSERT INTO obra_etapa (id_obra, id_etapa)
							VALUES (:id_obra, :id_etapa)
							");
						$sql->bindValue(":id_etapa", $etapas[$q]['id_etapa']);
						$sql->bindValue(":id_obra", $id_obra);

						$sql->execute();
					}
				}
			} else {

				error_log(print_r('erro', 1));
			}
		} catch (PDOExecption $e) {
			$sql->rollback();
			error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
		}


		return $this->retorno;
	}

	public function getEtapas($id_obra)
	{

		$sql = "SELECT * FROM  
			obra_etapa obrt
			INNER JOIN etapa etp ON (obrt.id_etapa = etp.id)
		WHERE id_obra = :id_obra";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_obra", $id_obra);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	public function getEtapasConcluidas($id_obra)
	{

		$r = 0;
		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM obra_etapa obrt WHERE (id_obra = :id_obra) AND (obrt.check = '1')");
		$sql->bindValue(':id_obra', $id_obra);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();
		}

		$r = $row['c'];

		return $r;
	}

	public function edit($Parametros)
	{
	

		if (isset($Parametros['id_obra']) && $Parametros['id_obra'] != '') {

			$sql = $this->db->prepare("UPDATE obra SET 
				obr_razao_social = :obra_nome
				
				WHERE id = :id_obra
        	");

			$sql->bindValue(":obra_nome", $Parametros['obra_nome']);
			$sql->bindValue(":id_obra", $Parametros['id_obra']);
			$sql->execute();

			if (isset($Parametros['check'])) {
				if (count($Parametros['check']) > 0) {
					for ($q = 0; $q < count($Parametros['check']); $q++) {

						$sql = $this->db->prepare("UPDATE obra_etapa obr SET
							obr.check = '1' 
				
							WHERE id_obra = :id_obra AND id_etapa = :id_etapa
							");
						$sql->bindValue(":id_etapa", $Parametros['check'][$q]);
						$sql->bindValue(":id_obra", $Parametros['id_obra']);

						$sql->execute();
					}
				}
			} else {

				error_log(print_r('erro', 1));
			}

		}
	}
}
