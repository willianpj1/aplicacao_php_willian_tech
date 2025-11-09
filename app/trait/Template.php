<?php

namespace app\trait;

use Slim\Views\Twig;

trait Template
{
    public function getTwig()
    {
        try {
            $twig = Twig::create(DIR_VIEW);
            #Adiciona variaveis globais ao template, acessiveis em qualquer template
            $twig->getEnvironment()->addGlobal('EMPRESA', 'Willian Tech');
            return $twig;
        } catch (\Exception $e) {
            throw new \Exception("restrição: " . $e->getMessage());
        }
    }
    public function setView($name)
    {
        return $name . EXT_VIEW;
    }
}
