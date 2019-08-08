<?php

class obrasController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->obra = new Obras();
        $this->cliente = new Cliente();
        $this->concessionaria = new Concessionaria();
        $this->servico = new Servicos();


        $this->user->setLoggedUser();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $this->painel = new Painel();
        $this->filtro = array();
        $this->dataInfo = array(
            'pageController' => 'obras',
            'nome_tabela'   => 'obras'
        );
    }

    public function index()
    {

        if ($this->user->hasPermission('obra_view')) {

            if (isset($_GET['filtros'])) {
                $this->filtro = $_GET['filtros'];
            }

            $this->dataInfo['p'] = 1;
			if (isset($_GET['p']) && !empty($_GET['p'])) {
				$this->dataInfo['p'] = intval($_GET['p']);
				if ($this->dataInfo['p'] == 0) {
					$this->dataInfo['p'] = 1;
				}
            }

            $this->dataInfo['tableDados'] = $this->obra->getAll($this->filtro, $this->user->getCompany());
            $this->dataInfo['getCount']   = $this->obra->getCount($this->user->getCompany());
            $this->dataInfo['p_count']    = ceil($this->dataInfo['getCount'] / 10);

            $this->dataInfo['clientes'] = $this->cliente->getAll('', $this->user->getCompany());
            $this->dataInfo['concessionaria'] = $this->concessionaria->getAll('', $this->user->getCompany());
            $this->dataInfo['servico'] = $this->servico->getAll('', $this->user->getCompany());

            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
            
        } else {
            $this->loadViewError();
        }
    }


    public function add()
    {
        if ($this->user->hasPermission('obra_view')) {
            if (isset($_SESSION['formError']) && count($_SESSION['formError']) > 0) {

                $this->dataInfo['errorForm'] = $_SESSION['formError'];
                unset($_SESSION['formError']);
            }
        } else {
            $this->loadViewError();
        }
    }

    public function add_action()
    {

        if (isset($_POST['obra_nome']) && $_POST['obra_nome'] != '') {

            $result = $this->obra->add($_POST, $this->user->getCompany());

            $this->addValicao($result);

            header('Location:' . BASE_URL . $this->dataInfo['pageController']);
            exit();
        } else {
            $this->loadViewError();
        }
    }

    public function edit($id)
    {

        if ($this->user->hasPermission('obra_view') && $this->user->hasPermission('obra_edit')) {

            $this->dataInfo['tableInfo'] = $this->obra->getInfo($id, $this->user->getCompany());

            if (isset($_POST['sev_nome']) && isset($_POST['id'])) {

                $result = $this->painel->edit($_POST, $this->dataInfo['nome_tabela'], $this->user->getCompany());
                $this->addValicao($result);

                header('Location:' . BASE_URL . $this->dataInfo['pageController']);
                exit();
            }
            $this->loadTemplate($this->dataInfo['pageController'] . "/editar", $this->dataInfo);
        } else {

            $this->loadViewError();
        }
    }

    public function delete($id)
    {

        if ($this->user->hasPermission('obra_view') && $this->user->hasPermission('obra_delete')) {
            
            $result = $this->obra->delete($id, $this->user->getCompany());

            header("Location: " . BASE_URL . $this->dataInfo['pageController']);

            if ($result) {
                $this->dataInfo['success'] = 'true';
                $this->dataInfo['mensagem'] = "Exclusão feita com sucesso!!";
            } else {
                $this->dataInfo['error'] = 'true';
                $this->dataInfo['mensagem'] = "Não foi possivel excluir!";
            }

        } else {
            $this->loadViewError();
        }
    }


    public function addValicao($result)
    {

        if ($result == 'sucess') {
            $_SESSION['form']['success'] = 'Success';
            $_SESSION['form']['type'] = 'success';
            $_SESSION['form']['mensagem'] = "Efetuado com sucesso!!";
        } elseif ($result == 'error') {
            $_SESSION['form']['success'] = 'Oops!!';
            $_SESSION['form']['type'] = 'error';
            $_SESSION['form']['mensagem'] = "Algo deu Errado, Contate o administrador do sistema";
        }

        return $_SESSION['form'];
    }

    
}
