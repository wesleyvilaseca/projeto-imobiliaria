<?php

namespace app\models;

use CoffeeCode\DataLayer\DataLayer;
use CoffeeCode\DataLayer\Connect;

class Faturas extends DataLayer
{
    private $db;

    public function __construct()
    {
        $this->db = Connect::getInstance();
        parent::__construct('faturas', ['contrato_id', 'data_vencimento', 'valor_fatura', 'valor_repasse', 'valor_taxaadministrativa', 'status_fatura', 'parcela_concorrente', 'status_repasse'], 'id', false);
    }

    public function update_statusfatura(int $status_fatura, int $fatura_id)
    {
        $sql = "update faturas set status_fatura={$status_fatura} where id={$fatura_id}";
        return  $this->db->query($sql);
    }

    public function update_statusrepasse(int $status_repasse, int $fatura_id)
    {
        $sql = "update faturas set status_repasse={$status_repasse} where id={$fatura_id}";
        return  $this->db->query($sql);
    }

    public function cancelaFaturas(int $contrato_id)
    {
        $sql = "update faturas set status_fatura=3 where contrato_id={$contrato_id} and status_fatura=0 or status_fatura=2";
        return $this->db->query($sql);
    }

    public function insert($data)
    {
        
    }
}
