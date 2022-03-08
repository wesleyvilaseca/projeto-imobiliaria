<?php

namespace app\services\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;
use app\models\ContratoAluguel;
use app\models\Faturas;
use app\models\Imoveis;
use DateTime;

class ContratoAluguelService
{
    use Validation;
    use Cripto;
    use DataSession;

    private $contrato_aluguel;
    private $faturas;
    private $imovel;

    public function __construct()
    {
        $this->contrato_aluguel = new ContratoAluguel;
        $this->faturas          = new Faturas;
        $this->imovel           = new Imoveis;
    }

    public function get_dados(array $periodo_faturas, $request)
    {
        $suport = function ($data, $request, $periodo_faturas, $position) {
            if ($data->format('d') !== "01") {

                $days = cal_days_in_month(CAL_GREGORIAN, $data->format('n'), $data->format('y'));
                $diff = $days == $data->format('d') ? $days : $days - $data->format('d');

                if ($position !== 1) {
                    $diff = $data->format('d');
                } else {
                    $diff = $days == $data->format('d') ? $days : $days - $data->format('d');
                }

                $condiminio     = tofloat($request['valor_condominio']) / $days;
                $iptu           = tofloat($request['valor_iptu']) / $days;
                $valor_aluguel  = tofloat($request['valor_aluguel']) / $days;
                return (object) [
                    'data_vencimento' => $periodo_faturas[$position],
                    'valor_aluguel' => $aluguel = tofloat($valor_aluguel * $diff),
                    'valor_iptu'    => $valor_iptu =  tofloat($iptu * $diff),
                    'condominio'    => $valor_condominio = tofloat($condiminio * $diff),
                    'valor_fatura'  => $total_fatura = tofloat($aluguel + $valor_iptu + $valor_condominio),
                    'taxa_adm'      => $taxa_adm = porcentagem($total_fatura, $request['taxa_administracao']),
                    'valor_repasse' => $total_fatura - $valor_condominio - $taxa_adm,
                    'parcela_concorrente' => $position
                ];
            }
            return (object) [
                'data_vencimento' => $periodo_faturas[$position],
                'valor_aluguel' => tofloat($request['valor_aluguel']),
                'valor_iptu'    => tofloat($request['valor_iptu']),
                'condominio'    => $valor_condominio = tofloat($request['valor_condominio']),
                'valor_fatura'  => $total_fatura = tofloat($request['valor_aluguel'] + $request['valor_iptu'] + $request['valor_condominio']),
                'taxa_adm'      => $taxa_adm = porcentagem($total_fatura, $request['taxa_administracao']),
                'valor_repasse' => $total_fatura - $valor_condominio - $taxa_adm,
                'parcela_concorrente' => $position
            ];
        };

        $array = [];
        $qtd = sizeof($periodo_faturas) - 1;

        foreach ($periodo_faturas as $key => $perido) {
            $data = new DateTime($perido);
            $position = ($key + 1) > $qtd ? $key : $key + 1; //pego a data que vai vencer

            //se a possição do array for a penultima, eu pulo ela, porque pode ser que ela não feche no dia primeiro
            if ($key == ($qtd - 1)) continue;

            $array[] = $suport($data, $request, $periodo_faturas, $position);
        }

        //acho que é isso
        return $array;
    }

    public function gerar_contrato(array $periodo_faturas, $request, $contrato)
    {
        $imovel = $this->imovel->find("id =: id and status_imovel=:status_imovel", "id={$request['imovel_id']}&status_imovel=1")->fetch();
        if (!$imovel) {
            return false;
        }
        
        $imovel->status_imovel  = 3;
        $imovelId               = $imovel->save();
        if (!$imovelId) {
            return false;
        }

        $dados_fatura           = $this->get_dados($periodo_faturas, $request);

        $contrato_aluguel = new ContratoAluguel;
        $contrato_aluguel->locatario_id         = $request['locatario_id'];
        $contrato_aluguel->imovel_id            = $request['imovel_id'];
        $contrato_aluguel->data_inicio          = $request['data_inicio'];
        $contrato_aluguel->data_fim             = $request['data_fim'];
        $contrato_aluguel->taxa_administracao   = tofloat($request['taxa_administracao']);
        $contrato_aluguel->valor_aluguel        = tofloat($request['valor_aluguel']);
        $contrato_aluguel->valor_condominio     = tofloat($request['valor_condominio']);
        $contrato_aluguel->valor_iptu           = tofloat($request['valor_iptu']);
        $contrato_aluguel->status_contrato      = 1;
        $contrato_aluguel->contrato             = $contrato;
        $result                                 = $contrato_aluguel->save();

        if (!$result) {
            return false;
        }

        $contratoId = $this->contrato_aluguel->getContratato($request['locatario_id'], $request['imovel_id'])->id;

        foreach ($dados_fatura as $f) {
            $fatura                             = new Faturas;
            $fatura->contrato_id                = $contratoId;
            $fatura->observacoes                = '';
            $fatura->codFatura                  = '';
            $fatura->data_vencimento            = $f->data_vencimento;
            $fatura->valor_fatura               = (float) $f->valor_fatura;
            $fatura->valor_repasse              = (float) $f->valor_repasse;
            $fatura->valor_taxaadministrativa   = (float) $f->taxa_adm;
            $fatura->status_fatura          = 0;
            $fatura->parcela_concorrente    = $f->parcela_concorrente;
            $fatura->status_repasse         = 0;
            $faturaId                       = $fatura->save();

            if (!$faturaId) {
                return false;
            }
        }

        return true;
    }
}
