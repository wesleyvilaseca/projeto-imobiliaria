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
use Exception;

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
        $contrato = $this->repository->findById($contrato_id);

        if (!$fatura) {
            setmessage(['tipo' => 'error', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        $sacado     = new Agente($contrato->locatario->nome, $contrato->locatario->email, $contrato->locatario->telefone, '0000-0000', 'Cidade', 'UF');
        $cedente    = new Agente('CodeVila Desenvolvimento de Softwares', '00.000.000/0001-00', 'Passagem h1 20', '66673-270', 'Belém', 'PA');

        $boleto = new BancoDoBrasil(array(
            // Parâmetros obrigatórios
            'dataVencimento' => new DateTime($fatura->data_vencimento),
            'valor' => $fatura->valor_fatura,
            'sequencial' => 1234567, // Para gerar o nosso número
            'sacado' => $sacado,
            'cedente' => $cedente,
            'agencia' => 4451, // Até 4 dígitos
            'carteira' => 18,
            'conta' => 2428-7, // Até 8 dígitos
            'convenio' => 1234, // 4, 6 ou 7 dígitos
        ));

        echo $boleto->getOutput();
    }

    public function getmodalFatura()
    {
        $request = filterpost($_POST);

        if (!$request['fatura_id'] || !$request['contrato_id']) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $fatura = $this->faturas->find("id=:id and contrato_id=:contrato_id", "id={$request['fatura_id']}&contrato_id={$request['contrato_id']}")->fetch();
        if (!$fatura) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        $options =  [
            (object) ['id' => 0, 'status' => 'Em aberto'],
            (object) ['id' => 1, 'status' => 'Paga'],
            (object) ['id' => 2, 'status' => 'Em atraso'],
            (object) ['id' => 3, 'status' => 'Cancelado'],
        ];

        $html = '<form method="POST" action="' . self::$route . '/atualizarStatusFatura/' . $fatura->id . '/' . $fatura->contrato_id . '">';
        $html .= '<div class="modal-header">';
        $html .= '<h5 class="modal-title"> Status fatura R$' . numberFormat($fatura->valor_fatura) . '</h5>';
        $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        $html .= '</div>';
        $html .= '<div class="modal-body">';

        $html .= '<small class="control-label">Status da fatura</small>';
        $html .= '<select class="form-select" id="status_fatura" name="status_fatura">';
        $html .= '<option selected disabled>Selecione uma opção</option>';

        foreach ($options as $status_fatura) {
            $selected = $status_fatura->id == $fatura->status_fatura ? 'selected' : '';
            $html .= '<option value="' . $status_fatura->id . '" ' . $selected . '>' . $status_fatura->status . '</option>';
        }
        $html .= '</select>';

        $html .= '</div>';
        $html .= '<div class="modal-footer">';
        $html .= '<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>';
        $html .= '<button type="submit" class="btn btn-primary btn-sm">Atualizar status</button>';
        $html .= '</div>';
        $html .= '</form>';

        return response_json(['msg' => '', 'success' => true, 'data' => $html]);
    }

    public function getmodalRepasse()
    {
        $request = filterpost($_POST);

        if (!$request['fatura_id'] || !$request['contrato_id']) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        if ($request['status_repasse'] == 1) {
            return response_json(['msg' => 'Não é possivel alterar o status do repasse de uma fatura que o repasse já foi efetuado', 'success' => false]);
        }

        $fatura = $this->faturas->find("id=:id and contrato_id=:contrato_id and status_repasse=:status_repasse", "id={$request['fatura_id']}&contrato_id={$request['contrato_id']}&status_repasse={$request['status_repasse']}")->fetch();

        if (!$fatura) {
            return response_json(['msg' => 'Operação não autorizada', 'success' => false]);
        }

        if ($fatura->status_repasse == 1) {
            return response_json(['msg' => 'Não é possivel alterar o status do repasse de uma fatura que o repasse já foi efetuado', 'success' => false]);
        }


        $options =  [
            (object) ['id' => 0, 'status' => 'Não efetuado'],
            (object) ['id' => 1, 'status' => 'Efetuado'],
        ];

        $html = '<form method="POST" action="' . self::$route . '/atualizarStatusRepasse/' . $fatura->id . '/' . $fatura->contrato_id . '">';
        $html .= '<div class="modal-header">';
        $html .= '<h5 class="modal-title"> Repasse R$' . numberFormat($fatura->valor_repasse) . '</h5>';
        $html .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        $html .= '</div>';
        $html .= '<div class="modal-body">';

        $html .= '<small class="control-label">Status do repasse</small>';
        $html .= '<select class="form-select" id="status_repasse" name="status_repasse">';
        $html .= '<option selected disabled>Selecione uma opção</option>';

        foreach ($options as $status_repasse) {
            $selected = $status_repasse->id == $fatura->status_repasse ? 'selected' : '';
            $html .= '<option value="' . $status_repasse->id . '" ' . $selected . '>' . $status_repasse->status . '</option>';
        }
        $html .= '</select>';

        $html .= '</div>';
        $html .= '<div class="modal-footer">';
        $html .= '<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Fechar</button>';
        $html .= '<button type="submit" class="btn btn-primary btn-sm">Atualizar status</button>';
        $html .= '</div>';
        $html .= '</form>';

        return response_json(['msg' => '', 'success' => true, 'data' => $html]);
    }

    public function atualizarStatusFatura(int $fatura_id = null, int $contrato_id)
    {
        if (!$fatura_id || !$contrato_id) {
            setmessage(['tipo' => 'warning', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        $request                = filterpost($_POST);
        $fatura = $this->faturas->find("id=:id and contrato_id=:contrato_id", "id={$fatura_id}&contrato_id={$contrato_id}")->fetch();
        if (!$fatura) {
            setmessage(['tipo' => 'warning', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        if ($request['status_fatura'] == $fatura->status_fatura) {
            return redirect(self::$route . '/index/' . $contrato_id);
        }

        $result                 = $this->faturas->update_statusfatura($request['status_fatura'], $fatura->id);

        if (!$result) {
            setmessage(['tipo' => 'warning', 'msg' => 'Erro na operação']);
            return redirect(self::$route . '/index/' . $contrato_id);
        }

        setmessage(['tipo' => 'success', 'msg' => 'Status da fatura atualizado com sucesso!']);
        return redirect(self::$route . '/index/' . $contrato_id);
    }

    public function atualizarStatusRepasse(int $fatura_id = null, int $contrato_id)
    {
        if (!$fatura_id || !$contrato_id) {
            setmessage(['tipo' => 'warning', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        $request                = filterpost($_POST);
        $fatura = $this->faturas->find("id=:id and contrato_id=:contrato_id", "id={$fatura_id}&contrato_id={$contrato_id}")->fetch();
        if (!$fatura) {
            setmessage(['tipo' => 'warning', 'msg' => 'Operação não autorizada']);
            return redirect(self::$route);
        }

        if ($request['status_repasse'] == $fatura->status_repasse) {
            return redirect(self::$route . '/index/' . $contrato_id);
        }

        $result                 = $this->faturas->update_statusrepasse($request['status_repasse'], $fatura->id);

        if (!$result) {
            setmessage(['tipo' => 'warning', 'msg' => 'Erro na operação']);
            return redirect(self::$route . '/index/' . $contrato_id);
        }

        setmessage(['tipo' => 'success', 'msg' => 'Status do repasse atualizado com sucesso!']);
        return redirect(self::$route . '/index/' . $contrato_id);
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
