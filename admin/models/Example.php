<?php

class Example extends model
{

	public function __construct($nomeTabela)
	{
		parent::__construct();

		$this->array = array();
		$this->retorno = array();

		$this->tabela = $nomeTabela;
	}

	public function getAll($filtro, $id_company)
	{

		$where = $this->buildWhere($filtro, $id_company);

		$sql = "
		SELECT * FROM  
			$this->tabela cli

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

		if (!empty($filtro['example'])) {

			if ($filtro['example'] != '') {

				$where[] = "cli.example LIKE :example";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['example'])) {
			if ($filtro['example'] != '') {
				$sql->bindValue(":example", '%' . $filtro['example'] . '%');
			}
		}

	}

	public function insert($id_company, $Parametros)
	{

		$tipo = "Inserido";

		try {
			$sql = $this->db->prepare("INSERT INTO $this->tabela SET 
        		Example = :example

			");

			$sql->bindValue(":example", $Parametros['example']);

			if ($sql->execute()) {
				controller::alert('success', 'Inserido com sucesso!!');
			} else {
				controller::alert('danger', 'Não foi possivel fazer a inserção');
			}

		} catch (PDOExecption $e) {
			$sql->rollback();
			error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
		}
		
		return $this->db->lastInsertId();
	}

	public function edit($Parametros)
	{
		$tipo = 'Editado';

		if (isset($Parametros['id'.$this->tabela]) && $Parametros['id'.$this->tabela] != '') {
			try {
				
				$sql = $this->db->prepare("UPDATE $this->tabela SET 
					
					example = :example

					WHERE id_$this->tabela = :id
	        	");

				$sql->bindValue(":example", $example);
				$sql->bindValue(":id", $Parametros['id'.$this->tabela]);
				
				if ($sql->execute()) {
					controller::alert('success', 'Editado com sucesso!!');
				} else {
					controller::alert('danger', 'Erro ao fazer a edição!!');
				}

			} catch (PDOExecption $e) {
				$sql->rollback();
				error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
			}	
		
		}else {
			controller::alert('danger', 'Não foi selecionado nenhum arquivo!!');

		}

	}

	public function delete($id, $id_company)
	{
		$tipo = 'Deletado';

		if (isset($Parametros['id'.$this->tabela]) && $Parametros['id'.$this->tabela] != '') {

			$sql = $this->db->prepare("DELETE FROM $this->tabela WHERE id_$this->tabela = :id AND id_company = :id_company");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":id_company", $id_company);

			if ($sql->execute()) {
				controller::alert('success', 'Deletado com sucesso!!');
			} else {
				controller::alert('danger', 'Erro ao deletar!!');
			}

		}else {
			controller::alert('danger', 'Não foi selecionado nenhum arquivo!!');
		}
	}

	public function getCount($id_company)
	{

		$r = 0;

		$sql = $this->db->prepare("SELECT COUNT(*) AS count FROM $this->tabela WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		$row = $sql->fetch();
		$r = $row['count'];

		return $r;
	}

	public function searchByName($var, $id_company){

		$sql = $this->db->prepare("SELECT * FROM $this->tabela

			WHERE id_company = :id_company AND example like :example
		");

		$sql->bindValue(':example', '%'.$var.'%');
		$sql->bindValue(':id_company', $id_company);
		
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;

	}
}
