<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\ContratoAluguel;
use app\models\Imoveis;
use app\models\Locador;
use app\models\Locatario;
use app\request\admin\catalog\LocadorRequest;

class ContratoaluguelController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;
    private $locatario;
    private $locador;
    private $imoveis;
    private static $route = URL_BASE . 'admin-catalog-contratoaluguel';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->html[]       = $this->load()->controller('admin-common-topbar');
        $this->html[]       = $this->load()->controller('admin-common-sidemenu');
        $this->request      = new LocadorRequest;
        $this->repository   = new ContratoAluguel;
        $this->locatario    = new Locatario;
        $this->locador      = new Locador;
        $this->imoveis      = new Imoveis;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Contratos', 'active' => true];
        $dados['route_create']      = URL_BASE . 'admin-catalog-contratoaluguel/create';
        $dados['contratos']           = $this->repository->find()->fetch(true);
        $dados['title']             = 'Contratos';
        $dados["toptitle"]          = 'Contratos';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/contratoaluguel/index', $dados);
        destroydataform();
    }

    public function create()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-contratoaluguel', 'title' => 'Contratos'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Novo contrato', 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-contratoaluguel/store';
        $dados['route_back']        = URL_BASE . 'admin-catalog-contratoaluguel';
        $dados['title']             = 'Novo contrato';
        $dados["toptitle"]          = 'Novo contrato';
        $dados['locatarios']        = $this->locatario->find()->fetch(true);
        $dados['locadores']         = $this->locador->find()->fetch(true);
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/contratoaluguel/create', $dados);
    }

    public function edit($id = null)
    {
        if (!$id) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $locador = $this->repository->findById($id);
        if (!$locador) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $dados['usuario']           = $this->usuario;
        $dados['locador']            = $locador;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locador', 'title' => 'Locadores'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Editar Locador ' . $locador->nome, 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-locador/update/' . $locador->id;
        $dados['route_back']        = URL_BASE . 'admin-catalog-locador';
        $dados['title']             = 'Editar locador ' . $locador->nome;
        $dados["toptitle"]          = 'Editar locador ' . $locador->nome;
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/locador/create', $dados);
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
            $html .= '<option value="' . $imovel->id . '">'. $imovel->endereco . '</option>';
        }
        $html .= '</select>';

        return response_json(['msg' => '', 'success' => true, 'data' => $html]);
    }

    public function store()
    {
        $request =  $this->request->save(filterpost($_POST));
        $client              = $this->repository;
        $client->nome        = $request['nome'];
        $client->email       = $request['email'];
        $client->telefone    = $request['telefone'];
        $result                 = $client->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na operação, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Cliente criado com sucesso']);
        return redirect(self::$route);
    }

    public function update($id = null)
    {
        if (!$id) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $client = $this->repository->findById($id);
        if (!$client) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }


        $request =  $this->request->save(filterpost($_POST));

        if ($client->email !== $request['email']) {
            $exist = $this->repository->existEmail($request['email']);
            if ($exist) {
                setmessage(['tipo' => 'warning', 'msg' => 'Já existe um cadastro de locador com esse email']);
                setdataform($request);
                return redirectBack();
            }
        }

        if ($client->telefone !== $request['telefone']) {
            $exist = $this->repository->existTelefone($request['telefone']);
            if ($exist) {
                setmessage(['tipo' => 'warning', 'msg' => 'Já existe um cadastro de locador com esse telefone']);
                setdataform($request);
                return redirectBack();
            }
        }

        $client->nome        = $request['nome'];
        $client->email       = $request['email'];
        $client->telefone    = $request['telefone'];

        $result                 = $client->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na operação, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Locador editado com sucesso']);
        return redirect(self::$route);
    }

    public function remove($id = null)
    {
        if (!self::isAjax()) {
            setmessage(['tipo' => 'success', 'msg' => 'Operação não']);
            return redirectBack();
        }

        if (!$id) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $client = $this->repository->findById($id);
        if (!$client) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $result = $client->destroy();
        if (!$result) {
            return response_json(['msg' => 'Erro na operação', 'success' => false]);
        }

        return response_json(['msg' => 'Locador removido com sucesso', 'success' => true]);
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->mask();
        return $js;
    }
}
