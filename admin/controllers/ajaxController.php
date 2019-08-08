<?php
class ajaxController extends controller
{

    public function __construct()
    {


        $u = new Users();
        if ($u->isLogged() == false) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }

    public function index()
    { }

    public function search_servico()
    {
        $data = array();
        $u = new Users();
        $a = new Servicos();
        $u->setLoggedUser();


        $servico = $a->getALL('', $u->getCompany());

        foreach ($servico as $citem) {
            $data[] = array(
                'name' => $citem['sev_nome'],
                'id'   => $citem['id']
            );
        }



        echo json_encode($servico);
    }


    public function search_categoria()
    {
        $u = new Users();
        $u->setLoggedUser();
        $data = array();

        $id_concessionaria = $_REQUEST['id_concessionaria'];
        $id_servico        = $_REQUEST['id_servico'];

        $a = new Servicos();
        $servico = $a->getEtapas($id_concessionaria, $id_servico);

        foreach ($servico as $citem) {
            $data[] = array(
                'id' => $citem['id'],
                'nome_sub_categoria'   => $citem['etp_nome']
            );
        }

        echo json_encode($data);
    }

    public function searchServicoByConcessionaria()
    {

        $data = array();
        $u = new Users();
        $a = new Servicos();
        $u->setLoggedUser();

        $servicoByConcessionaria = $a->getServicoByConcessionaria($_REQUEST['id_concessionaria']);

        foreach ($servicoByConcessionaria as $citem) {
            $data[] = array(
                'name_sev' => $citem['sev_nome'],
                'id_servico'   => $citem['id_servico']
            );
        }



        echo json_encode($servicoByConcessionaria);
    }

    public function search_cliente()
    {
        $data = array();
        $u = new Users();
        $a = new Cliente();
        $u->setLoggedUser();



        if (isset($_GET['q']) && !empty($_GET['q'])) {

            $q = addslashes($_GET['q']);

            $cliente = $a->searchClienteByName($q, $u->getCompany());

            foreach ($cliente as $citem) {
                $data[] = array(
                    'name' => $citem['cliente_nome'],
                    'id'   => $citem['id']
                );
            }
        }

        echo json_encode($data);
    }

    public function add_cliente()
    {
        $data = array();
        $u = new Users();
        $u->setLoggedUser();
        $a = new Cliente();
        $Parametros = array();

        if (isset($_POST['name']) && !empty($_POST['name'])) {


            $Parametros['cliente_nome'] = addslashes($_POST['name']);
            $Parametros['rg'] = '';
            $Parametros['email'] = '';
            $Parametros['cpf'] = '';

            $data['id'] = $a->add($u->getCompany(), $Parametros);
        }

        echo json_encode($data);
    }

    public function verificarMensagem()
    {
        
        $u = new Users();
        $u->setLoggedUser();
        $array = $u->verificarMensagem($u->getCompany(), $u->getId());


        echo json_encode($array);
        exit;
    }
}
