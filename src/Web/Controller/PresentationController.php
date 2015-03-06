<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class PresentationController
{
    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function indexAction(Request $request)
    {
        return new Response(
            $this->twig->render(
                'Presentation/index.html.twig',
                array(
                )
            )
        );
    }

    public function recordAction(Request $request)
    {
        return new Response(
            $this->twig->render(
                'Presentation/record.html.twig',
                array(
                )
            )
        );
    }

    public function uploadAction(Request $request)
    {
        return new Response(
            $this->twig->render(
                'Presentation/upload.html.twig',
                array(
                )
            )
        );
    }
}