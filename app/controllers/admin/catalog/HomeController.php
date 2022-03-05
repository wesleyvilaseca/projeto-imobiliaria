<?php

namespace app\controllers\admin\catalog;

use app\core\Controller;
use app\models\Configsite;
use app\models\Theme;
//use app\models\Home;

class HomeController extends Controller
{
    private $usuario;
    private $html;

    public function __construct()
    {       
        $this->usuario      = $this->getSession();
        $this->html[]       = $this->load()->controller('admin-common-topbar');
        $this->html[]       = $this->load()->controller('admin-common-sidemenu');
    }

    public function index()
    {
        $dados['usuario']           = $this->usuario;
        $dados['breadcrumb'][]      = ['route' => URL_BASE . 'admin-catalog-home', 'title' => 'Painel de controle', 'active' => true];
        $dados['title']             = 'Painel de controle ';
        $dados["toptitle"]          = 'Painel de controle';
        $dados['html']              = $this->html;
        $dados['js']                = $this->js();
        $view                       = "adm/pages/catalog/home/index";
        $this->renderView($view, $dados);
    }

    private function js()
    {
        $js = '<script src = "' . URL_BASE . 'assets/adm/js/plugins/chart/Chart.min.js"></script>';
        $js .= '<script src = "' . URL_BASE . 'assets/adm/js/inicioDash.js"></script>';
        $js .= $this->bootstrapjs();
        return $js;
    }
}
