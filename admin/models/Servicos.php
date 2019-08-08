<?php

class Servicos extends model
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

		$sql = "SELECT * FROM  
			servico sev		
		WHERE " . implode(' AND ', $where);

		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	private function buildWhere($filtro, $id)
	{
		$where = array(
			'id_company=' . $id
		);


		if (!empty($filtro['razao_social'])) {

			if ($filtro['razao_social'] != '') {

				$where[] = "sev.sev_nome LIKE :razao_social";
			}
		}

		if (!empty($filtro['id'])) {

			if ($filtro['id'] != '') {

				$where[] = "sev.id = :id";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['razao_social'])) {
			if ($filtro['razao_social'] != '') {
				$sql->bindValue(":razao_social", '%' . $filtro['razao_social'] . '%');
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
		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM servico WHERE id_company = :id_company");
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

	public function getEtapas($id_concessionaria, $id_servico)
	{

		$sql = "SELECT * FROM  
			etapas_servico_concessionaria etpsc
			INNER JOIN etapa etp ON (etpsc.id_etapa = etp.id)		
		WHERE etpsc.id_concessionaria = :id_concessionaria AND etpsc.id_servico = :id_servico";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_concessionaria", $id_concessionaria);
		$sql->bindValue(":id_servico", $id_servico);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	public function getServicoByConcessionaria($id_concessionaria)
	{

		$sql = "SELECT *, sev.id AS id_servico FROM concessionaria_servico consev
		INNER JOIN servico sev ON(sev.id = consev.id_servico) WHERE id_concessionaria = :id_concessionaria";

		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id_concessionaria", $id_concessionaria);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}
}
