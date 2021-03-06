<?php

namespace App\Entities;

class TwigEnvironement
{
    private $loader;
    private $twig;

    public function __construct(string $templatesLocation)
    {
        $this->loader = new \Twig_Loader_Filesystem($templatesLocation);
        $this->twig = new \Twig_Environment($this->loader, array(
           'cache' => false,//'src/temp',
           'debug' => false,
        ));
        $this->twig->addExtension(new \Twig_Extension_Debug());
    }

    public function getTwig()
    {
        return $this->twig;
    }
}
