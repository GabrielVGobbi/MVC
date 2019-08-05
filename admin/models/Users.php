<?php
class Users extends model

{

	private $userInfo;
	private $permissions;

	public function __construct()
	{
		parent::__construct();
		$this->array = array();
		$this->retorno = array();
	}

	//Verifica se o usuario esta Logado
	public function isLogged()
	{

		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {
			return true; //se a session esta aberta e não esta vazia retorna true

		} else {

			return false; //se a session esta aberta e não esta vazia retornao false
		}
	}

	//Verifica os dados do POST corretamente
	public function doLogin($login, $password)
	{

		$sql = $this->db->prepare("SELECT * FROM users WHERE login = :login AND password = :password AND usu_ativo = '1'");
		$sql->bindValue(':login', $login);
		$sql->bindValue(':password', md5($password));
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();

			$_SESSION['ccUser'] = $row['id'];

			return true;
		} else {
			return false;
		}
	}

	//Ver se o usuario esta logado e tem permissao
	public function setLoggedUser()
	{

		if (isset($_SESSION['ccUser']) && !empty($_SESSION['ccUser'])) {

			$id = $_SESSION['ccUser'];
			$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
			$sql->bindValue(':id', $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$this->permissions = new Permissions();
				$this->userInfo = $sql->fetch();
				$this->permissions->setGroup($id, $this->userInfo['id_company']);
			}
		} else {
			return false;
		}
	}

	//Logout do usuario
	public function logout()
	{

		session_destroy();
	}

	public function hasPermission($name)
	{

		return $this->permissions->hasPermission($name);
	}

	public function getCompany()
	{
		if (isset($this->userInfo['id_company'])) {

			return $this->userInfo['id_company'];
		} else
			return 0;
	}

	public function getGroup()
	{
		if (isset($this->userInfo['id_group'])) {

			return $this->userInfo['id_group'];
		} else
			return 0;
	}

	public function getId()
	{
		if (isset($this->userInfo['id'])) {

			return $this->userInfo['id'];
		} else
			return 0;
	}

	public function getEmail()
	{
		if (isset($this->userInfo['email'])) {

			return $this->userInfo['email'];
		} else
			return '';
	}

	public function getName()
	{
		if (isset($this->userInfo['login'])) {

			return $this->userInfo['login'];
		} else
			return '';
	}

	public function getAtivo()
	{
		if ($this->userInfo['usu_ativo'] == 0) {
			return false;
		} else {
			return true;
		}
	}


	public function getInfo($id, $id_company)
	{

		$array = array();

		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();


		if ($sql->rowCount() > 0) {
			$array = $sql->fetch();
		}

		return $array;
	}


	public function findUsersInGroup($id)
	{

		$sql = $this->db->prepare("SELECT COUNT(*) as c FROM users WHERE id_group = :group");
		$sql->bindValue(':group', $id);
		$sql->execute();
		$row = $sql->fetch();

		if ($row['c'] == '0') {
			return false;
		} else {
			return true;
		}
	}

	public function getList($offset, $filtro, $id)
	{

		$where = $this->buildWhere($filtro, $id);

		$sql = "SELECT * FROM users usr 

        
		WHERE " . implode(' AND ', $where) . " ORDER BY usr.id  ASC LIMIT $offset, 10";
				

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
			'usr.id_company=' . $id
		);


		if (!empty($filtro['id'])) {
			$where[] = "usr.id = :id";
		}

		if (!empty($filtro['login'])) {

			if ($filtro['login'] != '') {

				$where[] = "usr.login LIKE :login";
			}
		}

		return $where;
	}

	private function bindWhere($filtro, &$sql)
	{

		if (!empty($filtro['id'])) {
			$sql->bindValue(":id", $filtro['id']);
		}

		if (!empty($filtro['login'])) {
			$sql->bindValue(":login", '%' . $filtro['login'] . '%');
		}
	}

	public function edit($id_company, $Parametros)
	{
		$certo = true;
		$pass = 'admin';
		$sql = $this->db->prepare("UPDATE users SET login = :login, email = :email WHERE id = :id AND id_company = :id_company");

		$sql->bindValue(":id_company", $id_company);
		$sql->bindValue(":login", strtolower($Parametros['login']));
		$sql->bindValue(":email", strtolower($Parametros['email']));
		$sql->bindValue(":id", $Parametros['id_usuario']);

		$sql->execute();

		if (isset($Parametros['permission_check'])) {
			$param = implode(',',$Parametros['permission_check']);
			$sql = $this->db->prepare("UPDATE permission_groups SET params = :params WHERE id_usuario = :id AND id_company = :id_company");
			$sql->bindValue(":params", $param);
			$sql->bindValue(":id_company", $id_company);
			$sql->bindValue(":id", $Parametros['id_usuario']);
			if ($sql->execute()) {
				$certo = true;
			} else {
				$certo = false;
			}
		}else {
			$certo = false;
		}

		if($certo == true){
			return $this->retorno = 'sucess';
		}else {
			return $this->retorno = 'error';
		}
		
	}

	public function delete($id, $id_company)
	{

		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id AND id_company = :id_company");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();


		if ($sql->rowCount() > 0) {
			$user_info = $sql->fetch();
			$usu_ativo = $user_info['usu_ativo'];
		}

		if ($usu_ativo == 1) {
			$sql = $this->db->prepare("UPDATE users SET usu_ativo = 0 WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":id_company", $id_company);
			if ($sql->execute()) {
				controller::alert('success', 'Usuario desativado com sucesso!!');
			} else {
				controller::alert('danger', 'Não foi possivel desativar o usuario, contate o administrador do sistema');
			}
		} else {
			$sql = $this->db->prepare("UPDATE users SET usu_ativo = 1 WHERE id = :id AND id_company = :id_company");
			$sql->bindValue(":id", $id);
			$sql->bindValue(":id_company", $id_company);
			if ($sql->execute()) {
				controller::alert('success', 'Usuario ativado com sucesso');
			} else {
				controller::alert('danger', 'Não foi possivel ativar o usuario, contate o administrador do sistema');
			}
		}
	}

	public function getDashboardUsuario($id_usuario, $id_company)
	{
		$array = array();
		$sql = $this->db->prepare("

			SELECT * FROM user_dashboard uds

			INNER JOIN dashboard dash on uds.dashboard_id = dash.dashboard_id
			INNER JOIN users usr on uds.user_id = usr.id

			WHERE usr.id = :id_usuario AND usr.id_company = :id_company
			");

		$sql->bindValue(':id_company', $id_company);
		$sql->bindValue(':id_usuario', $id_usuario);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getCountUsuario($id, $filtro)
	{

		$r = 0;
		$where = $this->buildWhere($filtro, $id);

		$sql = "SELECT COUNT(*) AS c FROM
        	users usr
        WHERE " . implode(' AND ', $where);
		$sql = $this->db->prepare($sql);

		$this->bindWhere($filtro, $sql);
		
		$sql->execute();
		$row = $sql->fetch();
		$r = $row['c'];
		return $r;
	}

	
	public function hasPermissionByidSearch($name, $id_user, $id_company)
	{
		$sql = $this->db->prepare("SELECT * FROM permission_groups WHERE id_usuario = :id AND id_company = :id_company");
		$sql->bindValue(':id', $id_user);
		$sql->bindValue(':id_company', $id_company);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$row = $sql->fetch();

			if (empty($row['params'])) {
				$row['params'] = '0';
			}


			$params = $row['params'];

			$sql = $this->db->prepare("SELECT name FROM permission_params WHERE id IN($params) AND id_company = :id_company");
			$sql->bindValue(':id_company', $id_company);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				foreach ($sql->fetchAll() as $item) {
					$this->permissionById[] = $item['name'];
				}
			}
		}
		if (in_array($name, $this->permissionById)) {
			return true;
		} else {
			return false;
		}
	}

}
