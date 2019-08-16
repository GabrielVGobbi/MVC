<?php

class ConcessionariasController extends controller
{

    public function __construct()
    {
        parent::__construct();

        $this->user = new Users();
        $this->concessionaria = new Concessionaria();
        $this->servico = new Servicos();
        $this->documento = new Documentos();
        $this->painel = new Painel();

        $this->user->setLoggedUser();

        if ($this->user->isLogged() == false) {
            header("Location: " . BASE_URL . "login");
            exit();
        }

        $this->filtro = array();
        $this->dataInfo = array(
            'pageController' => 'concessionarias',
            'nome_tabela'   => 'concessionaria'
        );
    }

    public function index()
    {

        if ($this->user->hasPermission('concessionaria_view')) {

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

            $this->dataInfo['tableDados'] = $this->concessionaria->getAll($this->filtro, $this->user->getCompany());
            $this->dataInfo['getCount']   = $this->concessionaria->getCount($this->user->getCompany());
            $this->dataInfo['p_count']    = ceil($this->dataInfo['getCount'] / 10);

            $this->dataInfo['servico']    = $this->servico->getAll('0','', $this->user->getCompany());
            $this->dataInfo['documento']  = $this->documento->getAll('', $this->user->getCompany());



            $this->loadTemplate($this->dataInfo['pageController'] . "/index", $this->dataInfo);
        } else {
            $this->loadViewError();
        }
    }


    public function add()
    {
        if ($this->user->hasPermission('concessionaria_view')) {
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

        if (isset($_POST['razao_social']) && $_POST['razao_social'] != '') {

            $result = $this->concessionaria->add($this->user->getCompany(), $_POST, $_FILES);

            $this->addValicao($result);

            header('Location:' . BASE_URL . $this->dataInfo['pageController']);
            exit();
        } else {
            echo "erro";
        }
    }

    public function edit($id)
    {

        if ($this->user->hasPermission('concessionaria_view') && $this->user->hasPermission('concessionaria_edit')) {

            $this->dataInfo['tableInfo']                    = $this->concessionaria->getInfo($id, $this->user->getCompany());
            $this->dataInfo['servicos_concessionaria']      = $this->concessionaria->getServicoByConc($id, $this->user->getCompany());
            $this->dataInfo['servico']    = $this->servico->getAll('0','', $this->user->getCompany());



            if (isset($_POST['razao_social']) && isset($_POST['id'])) {

                //$result = $this->painel->edit($_POST, $this->dataInfo['nome_tabela'], $this->user->getCompany());


                $result = $this->concessionaria->edit($this->user->getCompany(), $_POST, $_FILES);

                $this->addValicao($result);

                header('Location:' . BASE_URL . $this->dataInfo['pageController'].'/edit'.'/'.$id);
                exit();
            }
            $this->loadTemplate($this->dataInfo['pageController'] . "/editar", $this->dataInfo);
        } else {

            $this->loadViewError();
        }
    }

    public function delete($id)
    {

        if ($this->user->hasPermission('concessionaria_view') && $this->user->hasPermission('concessionaria_delete')) {

            $result = $this->concessionaria->delete($id, $this->user->getCompany());

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
