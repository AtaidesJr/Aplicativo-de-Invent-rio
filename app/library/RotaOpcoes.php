<?php

namespace app\library;


class RotaOpcoes
{
    public function __construct(private readonly array $rotaOpcoes)
    {
    }

    public function opcoesExiste(string $index)
    {
        return !empty($this->rotaOpcoes) && isset($this->rotaOpcoes[$index]);
    }


    public function execute(string $index)
    {
        return $this->rotaOpcoes[$index];
    }
}
