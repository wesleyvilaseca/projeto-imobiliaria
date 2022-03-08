<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Imoveis extends DataLayer
{
    public function __construct()
    {
        parent::__construct('imoveis', ['locador_id', 'cep', 'endereco', 'bairro', 'uf', 'cidade', 'complemento', 'status_imovel'], 'id', false);
    }

    public function getImovel(int $locador_id, int $imovel_id)
    {
        return $this->find('locador_id =:locador_id and id =:id', "locador_id={$locador_id}&id={$imovel_id}")->fetch();
    }

    public function getImoveis(int $locador_id)
    {
        return $this->find('locador_id =:locador_id and status_imovel=:status_imovel', "locador_id={$locador_id}&status_imovel=1")->fetch(true);
    }

    public function imovelEmcontratoAtivo()
    {
        return (new ContratoAluguel)->find('imovel_id =:imovel_id and status_contrato=:status_contrato', "imovel_id={$this->id}&status_contrato=1")->fetch();
    }

    public function locador()
    {
        return (new Locador)->find('id =:id', "id={$this->locador_id}")->fetch();
    }
}
