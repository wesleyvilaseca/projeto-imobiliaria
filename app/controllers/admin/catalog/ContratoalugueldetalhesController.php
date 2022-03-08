<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\ContratoAluguel;
use app\models\Faturas;
use app\models\Imoveis;
use app\models\Locador;
use app\models\Locatario;
use app\request\admin\catalog\ContratoAluguelRequest;
use app\services\admin\catalog\ContratoAluguelService;

use OpenBoleto\Banco\BancoDoBrasil;
use OpenBoleto\Agente;

use DateTime;

class ContratoalugueldetalhesController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;

    private $faturas;
    private static $route = URL_BASE . 'admin-catalog-contratoalugueldetalhes';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->html[]       = $this->load()->controller('admin-common-topbar');
        $this->html[]       = $this->load()->controller('admin-common-sidemenu');
        $this->request      = new ContratoAluguelRequest;
        $this->repository   = new ContratoAluguel;
        $this->locatario    = new Locatario;
        $this->locador      = new Locador;
        $this->imoveis      = new Imoveis;
        $this->service      = new ContratoAluguelService;
        $this->faturas      = new Faturas;
    }

    public function index(int $id = null)
    {
        if (!$id) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        $contrato = $this->repository->findById($id);
        if (!$contrato) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }
        $dados['contrato']          = $contrato;
        $dados['faturas']           = $this->faturas->find("contrato_id=:contrato_id", "contrato_id={$contrato->id}")->fetch(true);
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-contratoaluguel', 'title' => 'Contratos'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Contrato aluguel detalhes', 'active' => true];
        $dados['route_back']        = URL_BASE . 'admin-catalog-contratoaluguel';
        $dados['title']             = 'Contrato aluguel detalhes';
        $dados["toptitle"]          = 'Contrato aluguel detalhes';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/contratoaluguel_detalhes/index', $dados);
        destroydataform();
    }

    public function getContrato(int $id = null)
    {
        if (!$id) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        $contrato = $this->repository->findById($id);
        if (!$contrato) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        echo $contrato->contrato;
    }

    public function boleto(int $contrato_id, int $fatura_id)
    {
        $fatura   = $this->faturas->find("contrato_id=:contrato_id and id=:id", "contrato_id={$contrato_id}&id={$fatura_id}")->fetch();

        if(!$fatura) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        $sacado     = new Agente('Fernando Maia', '023.434.234-34', 'ABC 302 Bloco N', '72000-000', 'Brasília', 'DF');
        $cedente    = new Agente('Empresa de cosméticos LTDA', '02.123.123/0001-11', 'CLS 403 Lj 23', '71000-000', 'Brasília', 'DF');

        $boleto = new BancoDoBrasil(array(
            // Parâmetros obrigatórios
            'dataVencimento' => new DateTime('2013-01-24'),
            'valor' => 23.00,
            'sequencial' => 1234567, // Para gerar o nosso número
            'sacado' => $sacado,
            'cedente' => $cedente,
            'agencia' => 1724, // Até 4 dígitos
            'carteira' => 18,
            'conta' => 10403005, // Até 8 dígitos
            'convenio' => 1234, // 4, 6 ou 7 dígitos
        ));

        echo $boleto->getOutput();
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->mask();
        $js .= $this->datatableJquery();
        $js .= $this->dataTableActive('contrato_table');
        return $js;
    }
}
