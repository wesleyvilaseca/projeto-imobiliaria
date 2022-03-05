<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Imoveis extends DataLayer
{
    public function __construct()
    {
        parent::__construct('imoveis', ['locador_id', 'cep', 'endereco', 'bairro', 'uf', 'cidade', 'complemento'], 'id', false);
        
    }

    public function getImovel(int $locador_id, int $imovel_id)
    {
        return $this->find('locador_id =:locador_id and id =:id', "locador_id={$locador_id}&id={$imovel_id}")->fetch();
    }

    public function getImoveis(int $locador_id) {
        return $this->find('locador_id =:locador_id', "locador_id={$locador_id}")->fetch(true);
    }
}
