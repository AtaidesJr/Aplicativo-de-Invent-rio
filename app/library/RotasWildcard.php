<?php

namespace app\library;

use app\enums\RotaWildCard;

class RotasWildcard

{

    private string $wildcardReplaced;
    private array $params = [];

    public function paramsDoArray(string $uri, string $wildcard, array $aliases)
    {
        $explodeUri = explode('/', ltrim($uri, '/'));
        $explodeWildcard = explode('/', ltrim($wildcard, '/'));
        $diferencasArray = array_diff($explodeUri, $explodeWildcard);


        $aliasesIndex = 0;

        foreach ($diferencasArray as $index => $parametro) {
            if (!$aliases) {
                $this->params[array_values($explodeUri)[$index - 1]] = is_numeric($parametro) ? (int)$parametro : $parametro;
            } else {
                $this->params[$aliases[$aliasesIndex]] = is_numeric($parametro) ? (int)$parametro : $parametro;
                $aliasesIndex++;
            }
        }
    }

    public function replaceWildcardPattern(string $uriParaSubstituir)
    {
        $this->wildcardReplaced = $uriParaSubstituir;
        if (str_contains($this->wildcardReplaced, '(:numeric)')) {
            $this->wildcardReplaced = str_replace('(:numeric)', RotaWildCard::numeric->value, $this->wildcardReplaced);
        }

        if (str_contains($this->wildcardReplaced, '(:alpha)')) {
            $this->wildcardReplaced = str_replace('(:alpha)', RotaWildCard::alpha->value, $this->wildcardReplaced);
        }

        if (str_contains($this->wildcardReplaced, '(:any)')) {
            $this->wildcardReplaced = str_replace('(:any)', RotaWildCard::any->value, $this->wildcardReplaced);
        }
    }

    public function  uriIgualPattern($atualUri, $wildcardReplaced)
    {
        $wildcard = str_replace('/', '\/', ltrim($wildcardReplaced, '\/'));

        return preg_match("/^$wildcard$/", ltrim($atualUri, '/'));
    }

    public function getWildcardReplaced(): string
    {
        return $this->wildcardReplaced;
    }

    public function getParams()
    {
        return $this->params ? [...$this->params] : [];
    }
}
