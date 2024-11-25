<?php

use app\Library\rotas;

try {

    // Todos os middlewares tem que ser passados na pasta : enums->RotaMiddlewares.php

    $rotas = new Rotas();

    $rotas->add('/', 'GET', 'LoginController:index');
    $rotas->add('/login/logando', 'POST', 'LoginController:loginAuth');
    $rotas->add('/login/sair', 'GET', 'LoginController:sair');
    $rotas->add('/home', 'GET', 'InventarioController:index');
    $rotas->add('/caixa_agrupamento', 'GET', 'AgrupamentoController:index');
    $rotas->add('/caixa_agrupamento/adicionar', 'POST', 'AgrupamentoController:adicionar');
    $rotas->add('/inventario/adicionar', 'POST', 'InventarioController:adicionar');
    $rotas->add('/itens_leitura', 'GET', 'InventarioController:itens');
    $rotas->add('/itens_leitura_datable', 'GET', 'InventarioController:datableItens');
    $rotas->add('/itens_leitura/atualizar', 'POST', 'InventarioController:atualizar');
    $rotas->add('/usuarios', 'GET', 'UsuarioController:index');
    $rotas->add('/usuarios/cadastrar', 'POST', 'UsuarioController:cadastrar');
    $rotas->add('/home_conferencia', 'GET', 'RelatorioConferenciaController:home');
    $rotas->add('/home_conferencia/caixa_agrupada', 'POST', 'RelatorioConferenciaController:datableCaixaAgrupada');
    $rotas->add('/visualizacao_caixa_agrupada', 'POST', 'RelatorioConferenciaController:visualizacaoCaixaAgrupada');
    $rotas->add('/visualizacao_item_formulario', 'POST', 'RelatorioConferenciaController:visualizacaoItemForm');
    $rotas->init();
} catch (Exception $e) {
    var_dump($e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
}
