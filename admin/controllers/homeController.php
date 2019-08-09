<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();


        $this->user = new Users();
        $this->concessionaria = new Concessionaria();
        $this->servico = new Servicos();
        $this->cliente = new Cliente();
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
        $this->dataInfo['count_servico'] = $this->servico->getCount($this->user->getCompany());
        $this->dataInfo['count_cliente'] = $this->cliente->getCount($this->user->getCompany());
        $this->dataInfo['count_concessionaria'] = $this->concessionaria->getCount($this->user->getCompany());



        $this->loadTemplate($this->dataInfo['pageController']."/index", $this->dataInfo);
    }

}