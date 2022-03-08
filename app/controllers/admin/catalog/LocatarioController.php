<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\Locatario;
use app\request\admin\catalog\LocatorioRequest;

class LocatarioController extends Controller
{
    private $usuario;
    private $html;
    private $request;
    private $repository;
    private static $route = URL_BASE . 'admin-catalog-locatario';

    public function __construct()
    {
        $this->usuario      = $this->getSession();
        $this->html[]       = $this->load()->controller('admin-common-topbar');
        $this->html[]       = $this->load()->controller('admin-common-sidemenu');
        $this->request      = new LocatorioRequest;
        $this->repository   = new Locatario;
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => '#', 'title' => 'Locatarios', 'active' => true];
        $dados['route_create']      = URL_BASE . 'admin-catalog-locatario/create';
        $dados['locatarios']        = $this->repository->find()->fetch(true);
        $dados['title']             = 'Locatarios';
        $dados["toptitle"]          = 'Locatarios';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/locatario/index', $dados);
        destroydataform();
    }

    public function create()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locatario', 'title' => 'Locatarios'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Novo locatario', 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-locatario/store';
        $dados['route_back']        = URL_BASE . 'admin-catalog-locatario';
        $dados['title']             = 'Novo Locatario';
        $dados["toptitle"]          = 'Novo Locatario';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/locatario/create', $dados);
    }

    public function edit($id = null)
    {
        if (!$id) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $locatario = $this->repository->findById($id);
        if (!$locatario) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $dados['usuario']           = $this->usuario;
        $dados['locatario']            = $locatario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-locatario', 'title' => 'Locatarios'];
        $dados['breadcrumb'][]      = ['route' => URL_BASE . '#', 'title' => 'Editar locatario ' . $locatario->nome, 'active' => true];
        $dados['action']            = URL_BASE . 'admin-catalog-locatario/update/' . $locatario->id;
        $dados['route_back']        = URL_BASE . 'admin-catalog-locatario';
        $dados['title']             = 'Editar Locatario ' . $locatario->nome;
        $dados["toptitle"]          = 'Editar Locatario ' . $locatario->nome;
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();

        $this->renderView('adm/pages/catalog/locatario/create', $dados);
    }

    public function store()
    {
        $request =  $this->request->save(filterpost($_POST));

        $exist = $this->repository->existEmail($request['email']);
        if ($exist) {
            setmessage(['tipo' => 'warning', 'msg' => 'Já existe um cadastro de locatario com esse email']);
            setdataform($request);
            return redirectBack();
        }

        $exist = $this->repository->existTelefone($request['telefone']);
        if ($exist) {
            setmessage(['tipo' => 'warning', 'msg' => 'Já existe um cadastro de locatario com esse telefone']);
            setdataform($request);
            return redirectBack();
        }


        $locatario                      = $this->repository;
        $locatario->nome                = $request['nome'];
        $locatario->email               = $request['email'];
        $locatario->telefone            = $request['telefone'];
        $locatario->status_locatario    = $request['status_locatario'];
        $result                         = $locatario->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na operação, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Locatario criado com sucesso']);
        return redirect(self::$route);
    }

    public function update($id = null)
    {
        if (!$id) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }

        $locatario = $this->repository->findById($id);
        if (!$locatario) {
            redirect(self::$route);
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
        }


        $request =  $this->request->save(filterpost($_POST));

        if ($locatario->email !== $request['email']) {
            $exist = $this->repository->existEmail($request['email']);
            if ($exist) {
                setmessage(['tipo' => 'warning', 'msg' => 'Já existe um cadastro de locatario com esse email']);
                setdataform($request);
                return redirectBack();
            }
        }

        if ($locatario->telefone !== $request['telefone']) {
            $exist = $this->repository->existTelefone($request['telefone']);
            if ($exist) {
                setmessage(['tipo' => 'warning', 'msg' => 'Já existe um cadastro de locatario com esse telefone']);
                setdataform($request);
                return redirectBack();
            }
        }

        $locatario->nome                = $request['nome'];
        $locatario->email               = $request['email'];
        $locatario->telefone            = $request['telefone'];
        $locatario->status_locatario    = $request['status_locatario'];

        $result                         = $locatario->save();

        if (!$result) {
            setmessage(['tipo' => 'success', 'msg' => 'Erro na operação, tente novamente']);
            setdataform($request);
            return redirectBack();
        }

        setmessage(['tipo' => 'success', 'msg' => 'Locatario editado com sucesso']);
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

        $locatario = $this->repository->findById($id);
        if (!$locatario) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $result = $locatario->destroy();
        if (!$result) {
            return response_json(['msg' => 'Erro na operação', 'success' => false]);
        }

        return response_json(['msg' => 'Locatario removido com sucesso', 'success' => true]);
    }

    private function js()
    {
        $js = $this->bootstrapjs();
        $js .= $this->mask();
        $js .= $this->datatableJquery();
        $js .= $this->dataTableActive('locatario_table');
        return $js;
    }
}
