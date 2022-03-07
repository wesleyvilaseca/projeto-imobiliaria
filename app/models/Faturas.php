<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Faturas extends DataLayer
{
    public function __construct()
    {
        parent::__construct('faturas', ['contrato_id', 'data_vencimento', 'valor_fatura', 'valor_repasse', 'valor_taxaadministrativa', 'status_fatura', 'parcela_concorrente', 'status_repasse'], 'id', false);
    }
}
