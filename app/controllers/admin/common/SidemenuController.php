<?php

namespace app\controllers\admin\common;

use app\core\Controller;
use app\models\Modules;

class SidemenuController extends Controller
{
    private $menu;

    public function __construct()
    {
        #os menus id é a rota dos controllers dos menus
        $this->menu[] = ['menuid' => 'admin-catalog-home', 'name' => 'Dashboard', 'icon' => 'fas fa-tachometer-alt', 'url' => URL_BASE . 'admin-catalog-home'];
        $this->menu[] = ['menuid' => 'admin-catalog-locatario', 'name' => 'Locatario', 'icon' => 'fas fa-user-tie', 'url' => URL_BASE . 'admin-catalog-locatario'];
        $this->menu[] = ['menuid' => 'admin-catalog-locador', 'name'=> 'Locador', 'icon' => 'fas fa-user-tag', 'url' => URL_BASE . 'admin-catalog-locador'];       
        $this->menu[] = ['menuid' => 'admin-catalog-contratoaluguel', 'name'=> 'Contratos', 'icon' => 'fas fa-file-contract', 'url' => URL_BASE . 'admin-catalog-contratoaluguel'];
        
    }

    public function get($params = null)
    {
        $dados['menus']             = $this->menu;
        $dados['menuparantkey']     = $params;
        $dados['js']                = $this->js();
        $view                       = "adm/template/sidemenu";
        return $this->loadView($view, $dados);
    }

    private function js()
    {
        $js = '<script src="' . URL_BASE . 'assets/adm/js/plugins/sidebar/sidebar.js" type="text/javascript"></script>';
        $js .= $this->bootstrapjs();
        return $js;
    }
}
