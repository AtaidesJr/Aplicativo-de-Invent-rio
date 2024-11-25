<?php

namespace app\library;

use Exception;

class Controller
{
    // private const NAMESPACE = 'app\\controllers\\';

    private function controllerPath($rota, $controller)
    {
        return ($rota->getRotaOpcoesInstacia() && $rota->getRotaOpcoesInstacia()->opcoesExiste('controller')) ?
            "app\\controllers\\" .  $rota->getRotaOpcoesInstacia()->execute('controller') . '\\' . $controller :
            "app\\controllers\\" . $controller;
    }

    public function call(Rota $rota)
    {


        $controller = $rota->controller;

        # Verifica se existe o dois pontos no controller
        if (!str_contains($controller, ':')) {
            throw new Exception("Não encontrado os dois pontos no {$controller} na rota!");
        }

        [$controller, $action] = explode(':', $controller);


        $controllerInstacia = $this->controllerPath($rota, $controller);


        # Verificar se a classe onde contém o method não existe;
        if (!class_exists($controllerInstacia)) {
            throw new Exception("O controller {$controller} não existe!");
        }


        $controller = new $controllerInstacia;

        # Verificar se o method não existe no controller;
        if (!method_exists($controller, $action)) {
            throw new Exception("O method {$action} não existe!");
        }


        if ($rota->getRotaOpcoesInstacia()?->opcoesExiste('middlewares')) {
            (new Middleware($rota->getRotaOpcoesInstacia()->execute('middlewares')))->execute();
        }

        // $params = $rota->getRotasWildcardInstacia()->getParams();

        call_user_func_array([$controller, $action], $rota->getRotasWildcardInstacia()?->getParams() ?? []);
    }
}
