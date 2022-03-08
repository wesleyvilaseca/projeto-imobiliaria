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
use DateTime;

class ContratoalugueldetalhesController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;
    private $locatario;
    private $locador;
    private $imoveis;
    private $service;
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

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->mask();
        $js .= $this->datatableJquery();
        $js .= $this->dataTableActive('contrato_table');
        return $js;
    }
}
