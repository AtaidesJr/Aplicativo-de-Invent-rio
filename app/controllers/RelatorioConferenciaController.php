<?php

namespace app\controllers;

use app\database\models\ConferenciaModel;
use app\database\models\InventarioModel;
use app\library\View;
use PDOException;

class RelatorioConferenciaController
{
    public function home()
    {
        $viewInstance = new View();
        $viewInstance->renderizar('home_conferencia');
    }

    public function visualizacaoCaixaAgrupada()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $cod_form  = (isset($_POST['cod_form']))  ? $_POST['cod_form'] : '';

            $conferenciaModel = new ConferenciaModel();
            $resultados       = $conferenciaModel->resultadoCaixaAgrupada($cod_form);

            if (empty($resultados)) {

                $_SESSION['atencao'] =  'O formulário digitado, não foi encontrada na base de dados!';
                header('location:/home_conferencia');
                exit;
            }
        }

        $viewInstance = new View();
        $viewInstance->renderizar('visualizacao_caixa_agrupada',  ['resultados' => $resultados]);
    }


    public function visualizacaoItemForm()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $cod_form  = (isset($_POST['cod_form']))  ? $_POST['cod_form'] : '';

            $conferenciaModel = new ConferenciaModel();
            $resultados       = $conferenciaModel->resultadoItemForm($cod_form);

            if (empty($resultados)) {

                $_SESSION['atencao'] =  'O formulário digitado, não foi encontrada na base de dados!';
                header('location:/home_conferencia');
                exit;
            }
        }

        $viewInstance = new View();
        $viewInstance->renderizar('visualizacao_item_formulario',  ['resultados' => $resultados]);
    }

    // public function datableCaixaAgrupada()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //         $dados_requesicao = $_REQUEST;

    //         $cod_form  = (isset($_POST['cod_form']))  ? $_POST['cod_form'] : '';

    //         $conferenciaModel = new ConferenciaModel();
    //         $resultados       = $conferenciaModel->resultadoCaixaAgrupada($cod_form);
    //         $count_resultados = $conferenciaModel->countResultadoCaixaAgrupada($cod_form);

    //         $dados = [];

    //         foreach ($resultados as $resultado) {

    //             $secao = mb_convert_encoding($resultado['Secao'], 'UTF-8', 'auto');

    //             $dados[] = [
    //                 $resultado['Deposito'],
    //                 $secao,
    //                 $resultado['Caixa'],
    //                 $resultado['Formulario'],
    //                 $resultado['Total'],
    //             ];
    //         }


    //         foreach ($count_resultados as $resultado) {
    //             $countDados = $resultado['Contador'];
    //         }

    //         $retornoAjax = [

    //             "draw"            => 1,
    //             "recordsTotal"    => $countDados,
    //             "recordsFiltered" => $countDados,
    //             "data"            => $dados
    //         ];

    //         echo json_encode($retornoAjax);

    //         // echo '<pre>';
    //         // print_r($retornoAjax);
    //         // die();
    //         // echo '</pre>';
    //     }
    // }
}
