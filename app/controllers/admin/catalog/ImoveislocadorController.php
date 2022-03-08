<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\Imoveis;
use app\models\Locador;
use app\request\admin\catalog\ImoveislocadorRequest;

class ImoveislocadorController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;
    private $locador;
    private static $route = URL_BASE . 'admin-catalog-imoveislocador';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->html[]       = $this->load()->controller('admin-common-topbar');
        $this->html[]       = $this->load()->controller('admin-common-sidemenu');
        $this->locador      = new Locador;
        $this->request      = new ImoveislocadorRequest;
        $this->repository   = new Imoveis;
    }

    public function index(int $id = null)
    {
        if (!$id) {
            redirect(URL_BASE . 'admin-catalog-locador');
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $locador = $this->locador->findById($id);
        if (!$locador) {
            redirect(URL_BASE . 'admin-catalog-locador');
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $dados['usuario']           = $this->usuario;
        $dados['locador']           = $locador;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locador', 'title' => 'Locadores'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Imoveis locador ' . $locador->nome, 'active' => 'true'];
        $dados['route_create']      = URL_BASE . 'admin-catalog-imoveislocador/create/' . $locador->id;
        $dados['route_back']        = URL_BASE . 'admin-catalog-locador';
        $dados['imoveis']           = $this->repository->find("locador_id =:locador_id", "locador_id={$locador->id}")->fetch(true);
        $dados['title']             = 'Imoveis locador ' . $locador->nome;
        $dados["toptitle"]          = 'Imoveis locador ' . $locador->nome;
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/imoveislocador/index', $dados);
        destroydataform();
    }

    public function create(int $id = null)
    {
        if (!$id) {
            redirect(URL_BASE . 'admin-catalog-locador');
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $locador = $this->locador->findById($id);
        if (!$locador) {
            redirect(URL_BASE . 'admin-catalog-locador');
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $dados['usuario']           = $this->usuario;
        $dados['locador']           = $locador;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locador', 'title' => 'Locadores'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-imoveislocador/index/' . $locador->id, 'title' => 'Imoveis locador ' . $locador->nome];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Novo imovel locador ' . $locador->nome, 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-imoveislocador/store/' . $locador->id;
        $dados['route_back']        = URL_BASE . 'admin-catalog-imoveislocador/index/' . $locador->id;
        $dados['title']             = 'Novo imovel locador ' . $locador->nome;
        $dados["toptitle"]          = 'Novo imovel locador ' . $locador->nome;
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/imoveislocador/create', $dados);
    }

    public function edit($id = null, $imovel_id = null)
    {
        if (!$id || !$imovel_id) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirectBack();
        }

        $locador = $this->locador->findById($id);
        $imovel  = $this->repository->getImovel($id, $imovel_id);
        if (!$locador || !$imovel) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirectBack();
        }

        $dados['usuario']           = $this->usuario;
        $dados['locador']           = $locador;
        $dados['imovel']            = $imovel;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locador', 'title' => 'Locadores'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-imoveislocador/index/' . $locador->id, 'title' => 'Imoveis locador ' . $locador->nome];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Editar imovel Locador ' . $locador->nome, 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-imoveislocador/update/' . $locador->id . '/' . $imovel->id;
        $dados['route_back']        = URL_BASE . 'admin-catalog-imoveislocador/index/' . $locador->id;
        $dados['title']             = 'Editar imovel locador ' . $locador->nome;
        $dados["toptitle"]          = 'Editar imovel locador ' . $locador->nome;
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/imoveislocador/create', $dados);
    }

    public function store(int $id = null)
    {
        if (!$id) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirectBack();
        }

        $locador = $this->locador->findById($id);

        if (!$locador) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirectBack();
        }

        $request =  $this->request->save(filterpost($_POST));

        $imovel                 = $this->repository;
        $imovel->locador_id     = $request['locador_id'];
        $imovel->cep            = $request['cep'];
        $imovel->endereco       = $request['endereco'];
        $imovel->numero         = $request['numero'] ?: null;
        $imovel->bairro         = $request['bairro'];
        $imovel->uf             = $request['uf'];
        $imovel->cidade         = $request['cidade'];
        $imovel->complemento    = $request['complemento'];
        $imovel->status_imovel  = $request['status_imovel'];
        $result                 = $imovel->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na operação, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Imovel cadastrado com sucesso']);
        return redirect(self::$route . '/index/' . $locador->id);
    }

    public function update(int $id = null, int $imovel_id = null)
    {
        if (!$id || !$imovel_id) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirectBack();
        }

        $locador    = $this->locador->findById($id);
        $imovel     = $this->repository->getImovel($id, $imovel_id);
        if (!$imovel || !$locador) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirectBack();
        }


        $request =  $this->request->save(filterpost($_POST), $imovel_id);

        $imovel->locador_id     = $request['locador_id'];
        $imovel->cep            = $request['cep'];
        $imovel->endereco       = $request['endereco'];
        $imovel->numero         = $request['numero']?:null;
        $imovel->bairro         = $request['bairro'];
        $imovel->uf             = $request['uf'];
        $imovel->cidade         = $request['cidade'];
        $imovel->complemento    = $request['complemento'];
        $imovel->status_imovel  = $request['status_imovel'];

        $result                 = $imovel->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na operação, tente novamente']);
            setdataform($request);
            return redirect(self::$route . '/edit/' . $id . '/' . $imovel_id);
        }

        setmessage(['tipo' => 'success', 'msg' => 'Imovel editado com sucesso']);
        return redirect(self::$route . '/index/' . $locador->id);
    }

    public function remove(int $id = null, int $imovel_id)
    {
        if (!self::isAjax()) {
            setmessage(['tipo' => 'success', 'msg' => 'Operação não']);
            return redirectBack();
        }

        if (!$id || !$imovel_id) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }
        
        $locador    = $this->locador->findById($id);
        $imovel     = $this->repository->getImovel($id, $imovel_id);
        if (!$imovel || !$locador) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $result = $imovel->destroy();
        if (!$result) {
            return response_json(['msg' => 'Erro na operação', 'success' => false]);
        }

        return response_json(['msg' => 'Imovel removido com sucesso', 'success' => true]);
    }


    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->mask();
        return $js;
    }
}
