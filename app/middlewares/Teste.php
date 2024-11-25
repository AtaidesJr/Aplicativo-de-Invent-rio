<?php

namespace app\middlewares;

use app\interfaces\MiddlewareInterface;

class Teste implements MiddlewareInterface
{
    public function execute()
    {
        // Inserir a função que será realizado pelo middlewares aqui

        // var_dump('executando Teste Middlewares');
    }
}
