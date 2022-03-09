<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;

class Locatario extends DataLayer
{
    public function __construct()
    {
        parent::__construct('locatario', ['nome', 'email', 'telefone', 'status_locatario'], 'id', false);
    }

    public function existEmail(string $email)
    {
        return $this->find('email =:email', "email={$email}")->fetch();
    }

    public function existTelefone(string $telefone)
    {
        return $this->find('telefone =:telefone', "telefone={$telefone}")->fetch();
    }

    public function contrato()
    {
        return (new ContratoAluguel)->find("locatario_id=:locatario_id", "locatario_id={$this->id}")->fetch();
    }
}
