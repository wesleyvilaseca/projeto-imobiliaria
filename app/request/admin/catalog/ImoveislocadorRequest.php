<?php

namespace app\request\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;

class ImoveislocadorRequest
{
    use Validation;
    use Cripto;
    use DataSession;
    private static $route = URL_BASE . 'admin-catalog-imoveislocador';

    private $inputs_required = ['cep', 'endereco', 'bairro', 'uf', 'cidade', 'complemento', 'locador_id'];

    public function save($request, $id = null)
    {
        $request['id'] = $id;
        foreach ($request as $requestkey => $requestitem) {
            foreach ($this->inputs_required as $item) {
                if ($requestkey == $item and !$requestitem) {
                    setmessage(['tipo' => 'warning', 'msg' => 'Os campos com asterisco (*) são de preenchimento obrigatório']);
                    setdataform($request);
                    if (!$id) {
                        return redirect(URL_BASE . 'admin-catalog-imoveislocador/create/' . $request['locador_id']);
                    }
                    return redirect(URL_BASE . 'admin-catalog-imoveislocador/edit/' . $request['locador_id'] . '/' . $id);

                }
            }
        }
        return $request;
    }
}
