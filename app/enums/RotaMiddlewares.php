<?php

namespace app\enums;

use app\middlewares\Teste;

enum RotaMiddlewares: string
{
    case teste = Teste::class;
}
