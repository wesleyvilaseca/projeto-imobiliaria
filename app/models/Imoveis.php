<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\DataLayer\Connect;

class Imoveis extends DataLayer
{
    private $db;

    public function __construct()
    {
        $this->db = Connect::getInstance();

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

    public function imovelEmContrato()
    {
        return (new ContratoAluguel)->find('imovel_id =:imovel_id', "imovel_id={$this->id}")->fetch();
    }

    public function locador()
    {
        return (new Locador)->find('id =:id', "id={$this->locador_id}")->fetch();
    }

    public function destroy_imoveis($locador_id) {
        $sql = "delete from imoveis where locador_id={$locador_id}";
        return  $this->db->query($sql);
    }
}
