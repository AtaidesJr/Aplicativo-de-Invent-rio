<?php

namespace app\controllers;

use app\database\models\AgrupamentoModel;
use app\database\models\InventarioModel;
use app\library\View;
use PDOException;

class AgrupamentoController
{
    public function index()
    {
        $viewInstance = new View();
        $viewInstance->renderizar('caixa_agrupamento');
    }

    public function adicionar()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $deposito         = (isset($_POST['deposito']))       ? $_POST['deposito']        : '';
            $secao            = (isset($_POST['secao']))          ? $_POST['secao']           : '';
            $caixa            = (isset($_POST['caixa']))          ? $_POST['caixa']           : '';
            $num_formulario   = (isset($_POST['num_formulario'])) ? $_POST['num_formulario']  : '';
            $usuario          = $_SESSION['usuario'];
            $qrcode           = $deposito . '_' . $secao . '_' . $caixa;


            $chave_consulta   = $deposito . '_' . $secao . '_' . $caixa . '_' . $num_formulario;

            $caixa_verificacao = substr($caixa, 0, 5);

            if ($caixa_verificacao != 'CAIXA') {

                $_SESSION['erro'] = "Etiqueta Inválida, Permitido Apenas Etiquetas de Agrupamentos!";
                header('location:/caixa_agrupamento');
                exit;
            }

            $agrupamentoModel = new AgrupamentoModel();
            $retorno          = $agrupamentoModel->resultadoAgrupado(utf8_decode($qrcode));


            $dados_agrupados  = [];

            foreach ($retorno as $importa_dados) {

                $dados_agrupados[] = [

                    'cod_item'        => $importa_dados['U_TI_ItemCode'],
                    'descricao_item'  => utf8_encode($importa_dados['U_TI_ItemName']),
                    'unid_item'       => $importa_dados['U_TI_Unid'],
                    'deposito_item'   => $importa_dados['U_TI_WhsCode'],
                    'num_formulario'  => $num_formulario,
                    'quantidade_item' => $importa_dados['U_TI_OnHand'],
                    'chave_consulta'  => $chave_consulta,
                    'usuario'         => $usuario,

                ];
            };

            if (empty($dados_agrupados)) {
                $_SESSION['erro'] = "Não Contém Itens Vinculados a Caixa e Seção Bipada!";
                header('location:/caixa_agrupamento');
                exit;
            }

            $inventarioModel = new InventarioModel();

            $verifica_chave = $inventarioModel->verificaDuplicidade($chave_consulta);

            if ($_SESSION['permissao_id'] == '0' && !empty($verifica_chave)) {

                $_SESSION['erro'] =  "Registro Já Adicionado Anteriormente, Favor Validar Junto ao Seu Supervisor!";
                header('location:/caixa_agrupamento');
                exit;
            } else {

                try {
                    $inventarioModel->insertInventarioMultiplos($dados_agrupados);

                    $_SESSION['sucesso'] = "Dados cadastrados com sucesso!";
                    header('location:/caixa_agrupamento');
                    exit;
                } catch (PDOException $e) {

                    $_SESSION['erro'] =  $e->getMessage();
                    header('location:/caixa_agrupamento');
                    exit;
                }
            }
        }
    }
}
