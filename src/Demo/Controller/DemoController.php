<?php

namespace Demo\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DemoController
{
    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function demoAction(Request $request)
    {
        return new Response(
            $this->twig->render(
                'Demo/demo.html.twig',
                array(
                )
            )
        );
    }
}
