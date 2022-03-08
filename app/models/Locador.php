<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Locador extends DataLayer
{
    public function __construct()
    {
        parent::__construct('locador', ['nome', 'email', 'data_repasse', 'status_locador'], 'id', false);
    }

    public function existEmail(string $email)
    {
        return $this->find('email =:email', "email={$email}")->fetch();
    }

    public function existTelefone(string $telefone)
    {
        return $this->find('telefone =:telefone', "telefone={$telefone}")->fetch();
    }

    public function imoveis()
    {
        return (new Imoveis)->find('locador_id =:locador_id', "locador_id={$this->id}")->fetch(true);
    }

    public function imovelDisponivel()
    {
        return (new Imoveis)->find('locador_id =:locador_id and status_imovel=:status_imovel', "locador_id={$this->id}&status_imovel=1")->fetch(true);
    }
}
