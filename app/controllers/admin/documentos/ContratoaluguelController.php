<?php

namespace app\controllers\admin\documentos;

use app\core\Controller;

class ContratoaluguelController extends Controller
{
    public function get($params = null)
    {
        $dados['locador']           = @$params['locador'];
        $dados['locatario']         = @$params['locatario'];
        $dados['imovel']            = @$params['imovel'];
        $dados['js']                = $this->js();

        return $this->loadView("adm/documentos/contrato_aluguel", $dados);
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        return $js;
    }
}
