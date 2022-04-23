<?php

namespace app\engine;

use app\interfaces\IRender;

class TwigRender implements IRender
{
    protected $twig;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(App::call()->config['templates_dir']);

        $this->twig = new \Twig\Environment($this->loader);
    }

    public function renderTemplate($template, $params = [])
    {
        $templatePath = $template . '.twig';

        return $this->twig->render($templatePath, $params);
    }
}
