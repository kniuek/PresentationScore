<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Web\Form\Type\PresentationType;

class PresentationController
{
    protected $twig;
    protected $formFactory;

    public function __construct($twig, $formFactory)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
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
        $form = $this->formFactory->create(new PresentationType());
        return new Response(
            $this->twig->render(
                'Presentation/upload.html.twig',
                array(
                    'form' => $form->createView()
                )
            )
        );
    }
}