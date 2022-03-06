<?php

namespace app\services\admin\catalog;

use app\classes\supports\supports_validation\Validation;
use app\classes\supports\supports_cripto\Cripto;
use app\classes\supports\supports_session\DataSession;
use DateTime;

class ContratoAluguelService
{
    use Validation;
    use Cripto;
    use DataSession;

    public function get_dados(array $periodo_faturas, $request)
    {
        $suport = function ($data, $request, $periodo_faturas, $position) {
            if ($data->format('d') !== "01") {
                $days = cal_days_in_month(CAL_GREGORIAN, $data->format('n'), $data->format('y'));
                $diff = $days == $data->format('d') ? $days : $days - $data->format('d');

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
                    'valor_repasse' => $total_fatura - $valor_condominio - $taxa_adm
                ];
            }
            return (object) [
                'data_vencimento' => $periodo_faturas[$position],
                'valor_aluguel' => tofloat($request['valor_aluguel']),
                'valor_iptu'    => tofloat($request['valor_iptu']),
                'condominio'    => $valor_condominio = tofloat($request['valor_condominio']),
                'valor_fatura'  => $total_fatura = tofloat($request['valor_aluguel'] + $request['valor_iptu'] + $request['valor_condominio']),
                'taxa_adm'      => $taxa_adm = porcentagem($total_fatura, $request['taxa_administracao']),
                'valor_repasse' => $total_fatura - $valor_condominio - $taxa_adm 
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
}
