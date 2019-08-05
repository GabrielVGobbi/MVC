<?php

class servicosController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->servico = new servicos();
        $this->user->setLoggedUser();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $this->painel = new Painel();
        $this->filtro = array();
        $this->dataInfo = array(
            'pageController' => 'servicos',
            'nome_tabela'   => 'servico'
        );
    }

    public function index()
    {

        if ($this->user->hasPermission('servico_view')) {

            if (isset($_GET['filtros'])) {
                $this->filtro = $_GET['filtros'];
            }

            $this->dataInfo['tableDados'] = $this->servico->getAll($this->filtro, $this->user->getCompany());
            $this->dataInfo['getCount']   = $this->servico->getCount($this->user->getCompany());
            $this->dataInfo['p_count']    = ceil($this->dataInfo['getCount'] / 10);


            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        } else {
            $this->loadViewError();
        }
    }


    public function add()
    {
        if ($this->user->hasPermission('servico_view')) {
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

        if (isset($_POST['sev_nome']) && $_POST['sev_nome'] != '') {

            $result = $this->painel->insert($_POST, $this->dataInfo['nome_tabela'], $this->user->getCompany());

            $this->addValicao($result);

            header('Location:' . BASE_URL . $this->dataInfo['pageController']);
            exit();
        } else {
            $this->loadViewError();
        }
    }

    public function edit($id)
    {

        if ($this->user->hasPermission('servico_view') && $this->user->hasPermission('servico_edit')) {

            $this->dataInfo['tableInfo'] = $this->servico->getInfo($id, $this->user->getCompany());

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

        if ($this->user->hasPermission('servico_view') && $this->user->hasPermission('servico_delete')) {
            
            $result = $this->servico->delete($id, $this->user->getCompany());

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
