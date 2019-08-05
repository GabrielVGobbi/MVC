<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();


        $this->user = new Users();
        $this->obras = new Obras();


        $this->user->setLoggedUser();
        $this->dataInfo = array();
        $this->dataInfo['errorForm'] = array();

      
        if($this->user->isLogged() == false){

            header("Location: ".BASE_URL."login");
            exit();
        }


        $this->dataInfo = array(
            'pageController' => 'dashboard',
            'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),

        );
    }

    public function index() {

        $this->dataInfo['count_obras'] = $this->obras->getCount($this->user->getCompany());

        $this->loadTemplate($this->dataInfo['pageController']."/index", $this->dataInfo);
    }

    public function add_link() {

        error_log(print_r($_GET,1));

        /*if(!empty($_POST['server'])){
            $location = explode('admin/', $_POST['server']);
            header('Location:'.BASE_URL.$location[1]);
            exit();

        }else {
            header('Location:'.BASE_URL.'link');
            exit();
        }*/


    }

    public function add() {

        if(isset($_SESSION['formError']) && count($_SESSION['formError']) > 0){

            $this->dataInfo['errorForm'] = $_SESSION['formError'];
            unset($_SESSION['formError']);      
        }

        $this->loadTemplate($this->dataInfo['pageController']."/modalCadastro", $this->dataInfo);    
    }

    public function action() {
        if(isset($_GET['id_link']) && $_GET['id_link'] != ''){
            $result = $this->link->edit($this->user->getCompany(),$this->user->getId(),$_GET);
        }else {
            $result = $this->link->add($this->user->getCompany(),$this->user->getId(),$_GET);
        }
        $this->Validacao($result);

        header('Location:'.BASE_URL.'home');
        exit();
    }

    public function Validacao($result){

        if(isset($result['link_add']['mensagem']['sucess'])){
            $_SESSION['form']['success'] = 'Success';
            $_SESSION['form']['type'] = 'success';
            $_SESSION['form']['mensagem'] = "Link Cadastrado com Sucesso";
        }else{
            $_SESSION['form']['success'] = 'Oops!!';
            $_SESSION['form']['type'] = 'error';
            $_SESSION['form']['mensagem'] = "Não foi Possivel Editar o Link";
        }
        error_log(print_r($_SESSION['form'],1));
        return $_SESSION['form'];

    }

}