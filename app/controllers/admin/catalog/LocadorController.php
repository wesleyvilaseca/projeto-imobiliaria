<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\Imoveis;
use app\models\Locador;
use app\request\admin\catalog\LocadorRequest;

class LocadorController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;
    private $imoveis;
    private static $route = URL_BASE . 'admin-catalog-locador';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->html[]       = $this->load()->controller('admin-common-topbar');
        $this->html[]       = $this->load()->controller('admin-common-sidemenu');
        $this->request      = new LocadorRequest;
        $this->repository   = new Locador;
        $this->imoveis      = new Imoveis;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Locadores', 'active' => true];
        $dados['route_create']      = URL_BASE . 'admin-catalog-locador/create';
        $dados['locadores']         = $this->repository->find()->fetch(true);
        $dados['title']             = 'Locadores';
        $dados["toptitle"]          = 'Locadores';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/locador/index', $dados);
        destroydataform();
    }

    public function create()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locador', 'title' => 'Locadores'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Novo locador', 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-locador/store';
        $dados['route_back']        = URL_BASE . 'admin-catalog-locador';
        $dados['title']             = 'Novo Locador';
        $dados["toptitle"]          = 'Novo Locador';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/locador/create', $dados);
    }

    public function edit($id = null)
    {
        if (!$id) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Opera????o n??o autorizada']);
        }

        $locador = $this->repository->findById($id);
        if (!$locador) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Opera????o n??o autorizada']);
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

    public function store()
    {
        $request =  $this->request->save(filterpost($_POST));

        $exist = $this->repository->existEmail($request['email']);
        if ($exist) {
            setmessage(['tipo' => 'warning', 'msg' => 'J?? existe um cadastro de locador com esse email']);
            setdataform($request);
            return redirectBack();
        }

        $exist = $this->repository->existTelefone($request['telefone']);
        if ($exist) {
            setmessage(['tipo' => 'warning', 'msg' => 'J?? existe um cadastro de locador com esse telefone']);
            setdataform($request);
            return redirectBack();
        }


        $locador                = $this->repository;
        $locador->nome          = $request['nome'];
        $locador->email         = $request['email'];
        $locador->telefone      = $request['telefone'];
        $locador->data_repasse  = $request['data_repasse'];
        $locador->status_locador  = $request['status_locador'];

        $result                 = $locador->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na opera????o, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Locador criado com sucesso']);
        return redirect(self::$route);
    }

    public function update($id = null)
    {
        if (!$id) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Opera????o n??o autorizada']);
        }

        $locador = $this->repository->findById($id);
        if (!$locador) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Opera????o n??o autorizada']);
        }

        $request =  $this->request->save(filterpost($_POST));

        if ($locador->email !== $request['email']) {
            $exist = $this->repository->existEmail($request['email']);
            if ($exist) {
                setmessage(['tipo' => 'warning', 'msg' => 'J?? existe um cadastro de locador com esse email']);
                setdataform($request);
                return redirectBack();
            }
        }

        if ($locador->telefone !== $request['telefone']) {
            $exist = $this->repository->existTelefone($request['telefone']);
            if ($exist) {
                setmessage(['tipo' => 'warning', 'msg' => 'J?? existe um cadastro de locador com esse telefone']);
                setdataform($request);
                return redirectBack();
            }
        }

        $locador->nome          = $request['nome'];
        $locador->email         = $request['email'];
        $locador->telefone      = $request['telefone'];
        $locador->data_repasse  = $request['data_repasse'];
        $locador->status_locador  = $request['status_locador'];

        $result                 = $locador->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na opera????o, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Locador editado com sucesso']);
        return redirect(self::$route);
    }

    public function remove($id = null)
    {
        if (!self::isAjax()) {
            setmessage(['tipo' => 'success', 'msg' => 'Opera????o n??o']);
            return redirectBack();
        }

        if (!$id) {
            return response_json(['msg' => 'Opera????o n??o autorizada', 'success' => false]);
        }

        $locador = $this->repository->findById($id);
        if (!$locador) {
            return response_json(['msg' => 'Opera????o n??o autorizada', 'success' => false]);
        }

        foreach ($locador->imoveis as $imovel) {
            if ($imovel->imovelEmContrato) {
                return response_json(['msg' => 'N??o ?? possivel removel este locador, pois ele possui residencia(s) com contrato(s) vinculado(s)', 'success' => false]);
            }
        }

        $result = $this->imoveis->destroy_imoveis($locador->id);
        if (!$result) {
            return response_json(['msg' => 'Erro na opera????o', 'success' => false]);
        }

        $result = $locador->destroy();
        if (!$result) {
            return response_json(['msg' => 'Erro na opera????o', 'success' => false]);
        }

        return response_json(['msg' => 'Locador removido com sucesso', 'success' => true]);
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->mask();
        $js .= $this->datatableJquery();
        $js .= $this->dataTableActive('locador_table');
        return $js;
    }
}
