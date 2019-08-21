<?php
class Controller
{

	protected $db;
	private $userInfo;

	public function __construct()
	{
		$u = new Users;
		$u->setLoggedUser();

		$this->userInfo = array(
			'userName' 	  	=> $u->getInfo($u->getId(), $u->getCompany()),
			'user'			=> $u,
			'notificacao'   => $u->getNotificacao($u->getId(), $u->getCompany())
		);
	}

	public function loadView($viewName, $viewData = array())
	{
		extract($viewData);
		include 'views/' . $viewName . '.php';
	}

	public function loadTemplate($viewName, $viewData = array())
	{
		extract($viewData);

		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData)
	{
		extract($viewData);
		include 'views/' . $viewName . '.php';
	}

	public function loadViewError()
	{
		include 'views/notAutorized/404.php';
	}

	public function alert($tipo, $mensagem)
	{

		$_SESSION['alert']['mensagem'] = $mensagem;
		$_SESSION['alert']['tipo'] = $tipo;

		return $_SESSION['alert'];
	}

	public static function ReturnValor($valor)
	{

		$valor = trim($valor);
		$valor = ucfirst($valor);

		return $valor;
	}

	public static function PriceSituation($valor)
	{

		$valor = trim($valor);
		$valor = str_replace(' ', '', $valor);
		$valor = str_replace('R$', '', $valor);
		$valor = explode(',', $valor);
		$valor = str_replace('.', '', $valor);

		return $valor[0];
	}

	public static function ReturnFormatLimpo($valor)
	{
		$valor = trim($valor);
		$valor = str_replace(' ', '', $valor);
		$valor = str_replace('-', '', $valor);
		$valor = str_replace('.', '', $valor);
		$valor = str_replace('/', '', $valor);

		return $valor;
	}

	public static function returnMobile()
	{
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'], "iPhone");
		$ipad = strpos($_SERVER['HTTP_USER_AGENT'], "iPad");
		$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'], "webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'], "iPod");
		$symbian =  strpos($_SERVER['HTTP_USER_AGENT'], "Symbian");

		if ($iphone || $ipad || $android || $palmpre || $ipod || $berry || $symbian == true) {
			$mobile = true;
		} else {
			$mobile = false;
		}

		return $mobile;
	}

	public  static function SomarData($data, $dias, $meses = 0, $ano = 0)
	{
		//passe a data no formato dd-mm-yyyy
		//yyyy-mm-dd
		$data = explode("-", $data);
		$newData = date("d-m-Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano));
		return $newData;
	}
}
