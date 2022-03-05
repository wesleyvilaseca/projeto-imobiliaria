<?php

namespace app\request\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;

class LocadorRequest
{
    use Validation;
    use Cripto;
    use DataSession;

    private $inputs_required = ['locador_id', 'locatario_id', 'imovel_id', 'contrato', 'data_inicio', 'data_fim', 'taxa_administracao', 'valor_aluguel', 'valor_condominio', 'valor_iptu'];

    public function save($request, $id = null)
    {
        $request['id'] = $id;
        foreach ($request as $requestkey => $requestitem) {
            foreach ($this->inputs_required as $item) {
                if ($requestkey == $item and !$requestitem) {
                    setmessage(['tipo' => 'warning', 'msg' => 'Os campos com asterisco (*) são de preenchimento obrigatório']);
                    setdataform($request);
                    if (!$id) {
                        return redirect(URL_BASE . 'admin-catalog-locador/create');
                    }
                    return redirect(URL_BASE . 'admin-catalog-locador/edit/' . $id);
                }
            }
        }
        return $request;
    }
}
