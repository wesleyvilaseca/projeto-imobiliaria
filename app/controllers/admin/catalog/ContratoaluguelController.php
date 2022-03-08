<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\ContratoAluguel;
use app\models\Imoveis;
use app\models\Locador;
use app\models\Locatario;
use app\request\admin\catalog\ContratoAluguelRequest;
use app\services\admin\catalog\ContratoAluguelService;
use DateTime;

class ContratoaluguelController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;
    private $locatario;
    private $locador;
    private $imoveis;
    private $service;
    private static $route = URL_BASE . 'admin-catalog-contratoaluguel';

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
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Contratos', 'active' => true];
        $dados['route_create']      = URL_BASE . 'admin-catalog-contratoaluguel/create';
        $dados['contratos']         = $this->repository->find()->fetch(true);
        $dados['title']             = 'Contratos';
        $dados["toptitle"]          = 'Contratos';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/contratoaluguel/index', $dados);
        destroydataform();
    }

    public function create()
    {
        $locador = $this->locador->find("status_locador =:status_locador", "status_locador=1")->fetch(true);

        $exist_imovel = false;
        foreach ($locador as $l) {
            if ($l->imovelDisponivel) {
                $exist_imovel = true;
                break;
            }
        }

        $dados['exist_imovel']         = $exist_imovel;
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-contratoaluguel', 'title' => 'Contratos'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Novo contrato', 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-contratoaluguel/store';
        $dados['route_back']        = URL_BASE . 'admin-catalog-contratoaluguel';
        $dados['title']             = 'Novo contrato';
        $dados["toptitle"]          = 'Novo contrato';
        $dados['locatarios']        = $this->locatario->find("status_locatario =:status_locatario", "status_locatario=1")->fetch(true);
        $dados['locadores']         = $this->locador->find("status_locador =:status_locador", "status_locador=1")->fetch(true);
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/contratoaluguel/create', $dados);
    }

    public function getImoveis(int $locador_id = null)
    {
        if (!$locador_id) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $locador = $this->locador->findById($locador_id);

        if (!$locador) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $imoveis = $this->imoveis->getImoveis($locador->id);

        if (!$imoveis) {
            return response_json(['msg' => 'O locador ' . $locador->nome . ' não possui imovei(s) cadastrado(s)', 'success' => false]);
        }

        $html = '<small class="control-label">Selecione o Imovel *</small>';
        $html .= '<select class="form-select" id="imovel_id" name="imovel_id" onchange="selectimovel()">';
        $html .= '<option selected disabled>Selecione uma opção</option>';
        foreach ($imoveis as $imovel) {
            if (!$imovel->imovelEmcontratoAtivo)
                $html .= '<option value="' . $imovel->id . '">' . $imovel->endereco . '</option>';
        }
        $html .= '</select>';

        return response_json(['msg' => '', 'success' => true, 'data' => $html]);
    }

    public function store()
    {
        $request =  $this->request->post();

        if ($request['data_inicio'] > $request['data_fim']) {
            setmessage(['tipo' => 'warning', 'msg' => 'A data do fim do contrato não pode ser menor que a data inicial']);
            setdataform($request);
            return redirect(self::$route . '/create');
        }

        $min_catrato = date('Y-m-d', strtotime('+1 year', strtotime($request['data_inicio'])));

        if ($request['data_fim'] < $min_catrato) {
            setmessage(['tipo' => 'warning', 'msg' => 'O periodo mínimo de contrato é de 1 ano']);
            setdataform($request);
            return redirect(self::$route . '/create');
        }

        $contrato = $this->load()->controller('admin-documentos-contratoaluguel', [
            [
                'locador'       => $this->locador->findById($request['locador_id']),
                'locatario'     => $this->locatario->findById($request['locatario_id']),
                'imovel'        => $this->imoveis->findById($request['imovel_id']),
            ]
        ]);

        $periodo = getPeriod($request['data_inicio'], $request['data_fim']);

        $contrato = $this->service->gerar_contrato($periodo, $request, $contrato);

        if (!$contrato) {
            setmessage(['tipo' => 'warning', 'msg' => 'Erro na operação']);
            redirect(self::$route);
        }

        setmessage(['tipo' => 'success', 'msg' => 'Contrato criado com sucesso']);
        return redirect(self::$route);
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
