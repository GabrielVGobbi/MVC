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

        error_log(print_r($_REQUEST,1));
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
}
