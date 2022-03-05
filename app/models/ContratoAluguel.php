<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class ContratoAluguel extends DataLayer
{
    public function __construct()
    {
        parent::__construct('contrato_aluguel', ['locador_id', 'locatario_id', 'imovel_id', 'contrato', 'data_inicio', 'data_fim', 'taxa_administracao', 'valor_aluguel', 'valor_condominio', 'valor_iptu'], 'id', false);
    }
}
