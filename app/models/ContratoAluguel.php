<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class ContratoAluguel extends DataLayer
{
    /**
     * status contrato
     * 1 - ativo
     * 2 - cancelado
     * 3 - encerrado por tempo
     */
    public function __construct()
    {
        parent::__construct('contrato_aluguel', ['locatario_id', 'imovel_id', 'contrato', 'data_inicio', 'data_fim', 'taxa_administracao', 'valor_aluguel', 'valor_condominio', 'valor_iptu'], 'id', false);
    }

    public function getContratato($locatario_id, $imovel_id)
    {
        return $this->find('locatario_id =:locatario_id AND imovel_id =:imovel_id', "locatario_id={$locatario_id}&imovel_id={$imovel_id}")->fetch();
    }

    public function imovel() 
    {
        return (new Imoveis)->find("id=:id", "id={$this->imovel_id}")->fetch();
    }

    public function locatario()
    {
        return (new Locatario)->find("id =:id", "id={$this->locatario_id}")->fetch();
    }
}
