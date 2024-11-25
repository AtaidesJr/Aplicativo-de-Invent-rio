<?php

namespace app\library;

class Rota
{

    private ?RotaOpcoes $rotaOpcoes = null;
    private ?Uri $uri = null;
    private ?RotasWildcard $rotasWildcard = null;

    public function __construct(
        // private string $uri,
        private readonly string $request,
        public readonly string $controller,
        public readonly array $wildcardAliases,
    ) {
    }


    public function addRotasGrupoOpcao(RotaOpcoes $rotaOpcoes)
    {
        $this->rotaOpcoes =  $rotaOpcoes;
    }


    public function getRotaOpcoesInstacia(): ?RotaOpcoes
    {
        return $this->rotaOpcoes;
    }


    public function addRotasUri(Uri $uri)
    {
        $this->uri =  $uri;
    }


    public function getRotasUriInstacia(): ?Uri
    {
        return $this->uri;
    }


    public function addRotasWildCard(RotasWildcard $rotasWildcard)
    {
        $this->rotasWildcard = $rotasWildcard;
    }


    public function getRotasWildcardInstacia(): ?RotasWildcard
    {
        return $this->rotasWildcard;
    }

    # Comparar as URI da rotas com a da URL e tipos de requesições atuais com definido nas rotas
    public function match()
    {

        if ($this->rotaOpcoes->opcoesExiste('prefixo')) {
            $this->uri->setUri(rtrim("/{$this->rotaOpcoes->execute('prefixo')}{$this->uri->getUri()}", '/'));
        }

        $this->rotasWildcard->replaceWildcardPattern($this->uri->getUri());
        $wildcardReplaced = $this->rotasWildcard->getWildcardReplaced();

        if ($wildcardReplaced != $this->uri->getUri() &&  $this->rotasWildcard->uriIgualPattern($this->uri->atualUri(), $wildcardReplaced)) {
            $this->uri->setUri($this->uri->atualUri());
            $this->rotasWildcard->paramsDoArray($this->uri->getUri(), $wildcardReplaced, $this->wildcardAliases);
        }


        if ($this->uri->getUri() === $this->uri->atualUri() && strtolower($this->request) === $this->uri->atualRequesicao()) {

            # retorna a propria instancia ROTA;
            return $this;
        }
    }
}
