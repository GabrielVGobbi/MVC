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
			'obr.id_company=' . $id
		);


		if (!empty($filtro['razao_social'])) {

			if ($filtro['razao_social'] != '') {

				$where[] = "sev.razao_social LIKE :razao_social";
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

	public function add($Parametros, $id_company)
	{
		try {
			$sql = $this->db->prepare("INSERT INTO obra SET 
					id_company = :id_company,
					id_servico = :id_servico,
					id_cliente = :id_cliente,
					id_concessionaria = :id_concessionaria,
					obr_razao_social = :razao_social

			
			");

			$sql->bindValue(":razao_social", $Parametros['obra_nome']);
			$sql->bindValue(":id_servico", $Parametros['servico']);
			$sql->bindValue(":id_cliente", $Parametros['id_cliente']);
			$sql->bindValue(":id_concessionaria", $Parametros['concessionaria']);
			$sql->bindValue(":id_company", $id_company);


			if ($sql->execute()) {
				controller::alert('success', 'Obra criado com sucesso!!');
	
			} else {
				controller::alert('error', 'Não foi possivel fazer o cadastro da obra, Contate o administrador do sistema!!');
			}

			$id = $this->db->lastInsertId();


		} catch (PDOExecption $e) {
			$sql->rollback();
			error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
		}


		return $this->retorno;
	}
}
