<?php

namespace app\library;

use Closure;
use app\library\Uri;

class Rotas
{

    private array $novasRotas = [];
    private array $rotaOpcoes = [];
    private Rota $rota;

    public function add(
        string $uri,
        string $request,
        string $controller,
        array  $wildcardAliases = []
    ) {

        $this->rota = new Rota($request, $controller, $wildcardAliases);
        $this->rota->addRotasUri(new Uri($uri));
        $this->rota->addRotasWildCard(new RotasWildcard);
        $this->rota->addRotasGrupoOpcao(new RotaOpcoes($this->rotaOpcoes));
        $this->novasRotas[] = $this->rota;

        return $this;
    }

    public function middleware(array $middlewares)
    {
        $opcoes = [];
        if (!empty($this->rotaOpcoes)) {
            $opcoes = array_merge($this->rotaOpcoes, ['middlewares' => $middlewares]);
        } else {
            $opcoes = ['middlewares' => $middlewares];
        }



        $this->rota->addRotasGrupoOpcao(new RotaOpcoes($opcoes));
    }


    public function group(array $rotaOpcoes, Closure $callback)
    {
        $this->rotaOpcoes = $rotaOpcoes;
        $callback->call($this);
        $this->rotaOpcoes = [];
    }

    public function init()
    {

        foreach ($this->novasRotas as $rota) {
            if ($rota->match()) {
                return (new Controller)->call($rota);
            }
        }

        return (new Controller)->call(new Rota('GET', 'NaoExisteController:index', []));
    }
}
