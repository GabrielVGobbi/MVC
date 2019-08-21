<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();

        //Login
        $this->user = new Users();
        $this->user->setLoggedUser();
        if($this->user->isLogged() == false){
            header("Location: ".BASE_URL."login");
            exit();
        }

        $this->dataInfo = array(
            'pageController' => 'dashboard',
            'user' => $this->user->getInfo($this->user->getId(), $this->user->getCompany()),
            'errorForm' => array(),
            'nome_tabela' => 'dashboard'
        );

        $this->example = new Example('cliente');
    }

    public function index() {

        $this->dataInfo['getAll'] = $this->example->getAll('',$this->user->getCompany());

        $this->loadTemplate($this->dataInfo['pageController']."/index", $this->dataInfo);

    }

}