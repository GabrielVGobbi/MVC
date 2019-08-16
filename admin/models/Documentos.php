<?php

class Documentos extends model
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
			documentos docs		
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

				$where[] = "docs.docs_nome LIKE :razao_social";
			}
		}

		if (!empty($filtro['id'])) {

			if ($filtro['id'] != '') {

				$where[] = "docs.id = :id";
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
		$sql = $this->db->prepare("SELECT COUNT(*) AS c FROM documentos WHERE id_company = :id_company");
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();
		}

		$r = $row['c'];

		return $r;
	}

	public function add($arquivos, $id_company, $id = 0)
	{

		
		
			$tmpname =  $arquivos['documento_arquivo']['name'];


			if (is_dir("assets/documentos/")) {
				$subiu = move_uploaded_file($arquivos['documento_arquivo']['tmp_name'], 'assets/documentos/' . '/' . $arquivos['documento_arquivo']['name']);
			} else {
				mkdir("assets/documentos/");
				$subiu = move_uploaded_file($arquivos['documento_arquivo']['tmp_name'], 'assets/documentos/' . '/' . $arquivos['documento_arquivo']['name']);
			}


			try {


				$sql = $this->db->prepare("INSERT INTO documentos (docs_nome,id_company)
								VALUES (:nome_documento, :id_company)
						");

				$sql->bindValue(":nome_documento", $arquivos['documento_arquivo']['name']);
				$sql->bindValue(":id_company", $id_company);
				if ($sql->execute()) {
					controller::alert('success', 'documento adicionado com sucesso!!');

					$id_obra = $this->db->lastInsertId();
				} else {
					controller::alert('error', 'Contate o administrador do sistema!!');
				}
			} catch (PDOExecption $e) {
				$sql->rollback();
				error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
			}

			if ($id != '' && $id_obra) {
				$this->addDocumentoObra($id, $id_obra);
			}
		
	}

	public function delete($id, $id_company)
	{

		$sql = $this->db->prepare("DELETE FROM documentos WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(":id", $id);
		$sql->bindValue(":id_company", $id_company);
		if ($sql->execute()) {
			controller::alert('danger', 'documento deletado com sucesso!!');
		} else {
			controller::alert('error', 'Usuario desativado com sucesso!!');
		}
	}

	public function getDocumentoObra($id_obra)
	{

		$sql = $this->db->prepare("
			SELECT * FROM documentos_obra docbr
			INNER JOIN documentos doc ON (doc.id = docbr.id_documento)
			WHERE  id_obra = :id_obra
		");

		$sql->bindValue(':id_obra', $id_obra);

		$sql->execute();

		if ($sql->rowCount() > 0) {
			$this->array = $sql->fetchAll();
		}

		return $this->array;
	}

	public function addDocumentoObra($id, $id_obra)
	{

		try {


			$sql = $this->db->prepare("INSERT INTO documentos_obra (id_documento,id_obra)
								VALUES (:id_obra, :id_documento)
						");

			$sql->bindValue(":id_documento", $id);
			$sql->bindValue(":id_obra", $id_obra);
			$sql->execute();

		} catch (PDOExecption $e) {
			$sql->rollback();
			error_log(print_r("Error!: " . $e->getMessage() . "</br>", 1));
		}
	}
}
