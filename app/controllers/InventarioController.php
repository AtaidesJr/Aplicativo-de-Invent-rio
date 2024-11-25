<?php

namespace app\controllers;

use app\database\models\InventarioModel;
use app\library\View;
use PDOException;

class InventarioController
{
    public function index()
    {
        $viewInstance = new View();
        $viewInstance->renderizar('home');
    }

    public function adicionar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $cod_item       = (isset($_POST['cod_item']))        ? $_POST['cod_item']        : '';
            $descricao      = (isset($_POST['descricao_item']))  ? $_POST['descricao_item']  : '';
            $unidade        = (isset($_POST['unidade_item']))    ? $_POST['unidade_item']    : '';
            $deposito       = (isset($_POST['deposito_item']))   ? $_POST['deposito_item']   : '';
            $num_formulario = (isset($_POST['num_formulario']))  ? $_POST['num_formulario']  : '';
            $quantidade     = (isset($_POST['quantidade_item'])) ? $_POST['quantidade_item'] : '';
            $usuario        = $_SESSION['usuario'];

            // Monta uma chave para cria um índice único, evitar duplicidade após leitura do QRCODE
            $chave_consulta  = $cod_item . '_' . $unidade . '_' . $deposito . '_' . $num_formulario . '_' . $quantidade;

            if ($num_formulario == 'undefined') {

                $_SESSION['erro'] = "Etiqueta Inválida, Permitido Apenas Etiquetas de Itens por Formulário!";
                header('location:/home');
                exit;
            }

            // echo '<pre>';
            // print_r($num_formulario);
            // die();
            // echo '</pre>';

            $inventarioModel = new InventarioModel();

            try {

                $verifica_chave = $inventarioModel->verificaDuplicidade($chave_consulta);

                if ($_SESSION['permissao_id'] == '0' && !empty($verifica_chave)) {

                    $_SESSION['erro'] =  "Registro já adicionado anteriormente, favor validar junto ao seu supervisor!";
                    header('location:/home');
                    exit;
                } else {

                    $inventarioModel->insertInventario($cod_item, $descricao, $unidade, $deposito, $num_formulario, $quantidade, $chave_consulta, $usuario);

                    $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
                    header('location:/home');
                    exit;
                }
            } catch (PDOException $e) {
                $_SESSION['erro'] =  $e->getMessage();
                header('location:/');
                exit;
            }
        }
    }

    public function itens()
    {

        $viewInstance = new View();
        $viewInstance->renderizar('itens_leitura');
    }

    public function datableItens()
    {

        $dados_requesicao = $_REQUEST;

        $inventarioModel  = new InventarioModel();
        $resultados       = $inventarioModel->retornaTodosItens();
        $count_resultados = $inventarioModel->countItens();

        $dados = [];

        foreach ($resultados as $index => $resultado) {

            $dados[] = [
                $resultado->usuario,
                $resultado->cod_item,
                $resultado->descricao_item,
                $resultado->unid_item,
                $resultado->quantidade_item,
                $resultado->deposito_item,
                $resultado->num_formulario,
                date('d-m-Y H:i:s', strtotime($resultado->data_criacao)),
                // Verificar se usuário logado tem a permissão de administrador
                $_SESSION['permissao_id'] == '1' ? $this->criaBotao($index, 'Editar', 'inventarioModal') . $this->criaEditarModal($index, $resultado) : null
            ];
        }

        foreach ($count_resultados as $resultado) {
            $countDados = $resultado->Contador;
        }

        $retornoAjax = [

            "draw"            => 1,
            "recordsTotal"    => $countDados,
            "recordsFiltered" => $countDados,
            "data"            => $dados
        ];

        echo json_encode($retornoAjax);
    }

    public function atualizar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $unid_item       = (isset($_POST['unid_item']))       ? $_POST['unid_item']       : '';
            $deposito_item   = (isset($_POST['deposito_item']))   ? $_POST['deposito_item']   : '';
            $num_formulario  = (isset($_POST['num_formulario']))  ? $_POST['num_formulario']  : '';
            $quantidade_item = (isset($_POST['quantidade_item'])) ? $_POST['quantidade_item'] : '';
            $id_item         = (isset($_POST['id_item']))         ? $_POST['id_item']         : '';

            $inventarioModel = new InventarioModel();

            try {

                $inventarioModel->updateItens($unid_item, $deposito_item, $num_formulario, $quantidade_item, $id_item);

                $_SESSION['sucesso'] =  'Dados Atualizados com Sucesso!';
                header('location:/itens_leitura');
                exit;
            } catch (PDOException $e) {
                $_SESSION['erro'] =  $e->getMessage();
                header('location:/home');
                exit;
            }
        }
    }

    private function criaBotao($index, $texto, $modal_id)
    {
        return '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#' . $modal_id . '-' . $index . '">' . $texto . '</button>
            </div>';
    }

    private function criaEditarModal($index, $resultado)
    {
        return '<div class="modal fade" id="inventarioModal-' . $index . '" tabindex="-1" aria-labelledby="inventarioModalLabel-' . $index . '" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title black fw-bold" id="inventarioModalLabel-' . $index . '">Item : ' . $resultado->cod_item . ' </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/itens_leitura/atualizar" method="POST" id="formAtualizaItem">
                                <div class="col">
                                    <label for="medicamento-' . $index . '" class="form-label black">Unidade :</label>
                                    <input id="medicamento-' . $index . '" class="form-control texto-cinza" name="unid_item" id="unidade" value="' . $resultado->unid_item . '" readonly>
                                    <br>
                                    <label for="medicamento-' . $index . '" class="form-label black">Depósito :</label>
                                    <input type="text" id="medicamento-' . $index . '" class="form-control texto-cinza" name="deposito_item" id="deposito" value="' .  $resultado->deposito_item . '">
                                    <br>
                                    <label for="medicamento-' . $index . '" class="form-label black">Formulário :</label>
                                    <input type="text" id="medicamento-' . $index . '" class="form-control texto-cinza" name="num_formulario" id="formulario" value="' . $resultado->num_formulario . '">
                                    <br>
                                    <label for="medicamento-' . $index . '" class="form-label black">Quantidade :</label>
                                    <input type="text" id="medicamento-' . $index . '" class="form-control texto-cinza" name="quantidade_item" id="quantidade" value="' . $resultado->quantidade_item . '">
                                    <br>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" id="btnAlterar" class="btn btn-success">Alterar</button>
                                    <input type="hidden" name="id_item" id="idItem" value="' . $resultado->id . '">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
    }
}
