<?php

namespace app\library;

use app\enums\RotaMiddlewares;
use app\interfaces\MiddlewareInterface;
use Exception;

class Middleware
{
    private string $middlewareClass;

    public function __construct(protected array $middlewares)
    {
    }



    private function middlewareExiste(string $middleware)
    {
        $casesMiddlewares =  RotaMiddlewares::cases();

        return array_filter($casesMiddlewares, function (RotaMiddlewares $middlewareCase) use ($middleware) {
            if ($middlewareCase->name === $middleware) {
                $this->middlewareClass = $middlewareCase->value;
                return true;
            }
            return false;
        });
    }


    public function execute()
    {
        foreach ($this->middlewares as $middleware) {
            if (!$this->middlewareExiste($middleware)) {
                throw new Exception("Middleware {$middleware} inexistente");
            }

            $class = $this->middlewareClass;
            if (!class_exists($class)) {
                throw new Exception("Classe Middleware {$middleware} inexistente");
            }

            $middlewareClass = new $class;

            if (!$middlewareClass instanceof MiddlewareInterface) {
                throw new Exception("No Middleware é Necessario implementar a interfaceMiddlewares");
            }



            $middlewareClass->execute();
        }
    }
}
