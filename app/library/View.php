<?php

namespace app\library;

use app\database\models\ContatosModel;
use app\database\models\VisitanteModel;
use Exception;
use League\Plates\Engine;

class View
{

    private $instancias = [];

    /**
     * Renderizar as instancias com as funções para renderizar no template
     */
    public function __construct()
    {
        // $this->addInstancia('visitanteModel', new VisitanteModel());
    }


    /**
     * Aqui adiciona as intancias
     */
    private function addInstancia($instanciaChave, $instanciaClasse)
    {
        if (!isset($this->instancias[$instanciaChave])) {
            $this->instancias[$instanciaChave] = new $instanciaClasse;
        }
    }


    /**
     * Renderizar as chamadas no template
     */
    public function renderizar(string $view, array $data = [])
    {
        $path = dirname(__FILE__, 3);
        $caminhoDoArquivo = $path . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

        if (!file_exists($caminhoDoArquivo . $view .  '.php')) {

            throw new Exception("A view {$view} não existe!");
        }

        $templates = new Engine($caminhoDoArquivo);

        // Adiciona as instâncias como dados do template
        $templates->addData(['instancias' => $this->instancias]);

        echo $templates->render($view, $data);
    }
}
