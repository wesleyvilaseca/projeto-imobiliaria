<?php

namespace app\request\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;

class ContratoAluguelRequest
{
    use Validation;
    use Cripto;
    use DataSession;

    public $request_get;
    public $request_post;

    private $inputs_required = ['locador_id', 'locatario_id', 'imovel_id', 'contrato', 'data_inicio', 'data_fim', 'taxa_administracao', 'valor_aluguel', 'valor_iptu'];

    public function __construct()
    {
        $this->request_post = $_POST;
        $this->request_get  = $_GET; 
    }

    public function post($id = null)
    {
        $this->request_post =  filterpost($this->request_post);
        $request['id'] = $id;
        foreach ($this->request_post as $requestkey => $requestitem) {
            foreach ($this->inputs_required as $item) {
                if ($requestkey == $item and !$requestitem) {
                    setmessage(['tipo' => 'warning', 'msg' => 'Os campos com asterisco (*) são de preenchimento obrigatório']);
                    setdataform($this->request_post);
                    if (!$id) {
                        return redirect(URL_BASE . 'admin-catalog-contratoaluguel/create');
                    }
                    return redirect(URL_BASE . 'admin-catalog-contratoaluguel/edit/' . $id);
                }
            }
        }
        return $this->request_post;
    }

    public function get() {
        return $this->request_get;
    }
}
