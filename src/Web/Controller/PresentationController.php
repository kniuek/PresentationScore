<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Web\Form\Type\PresentationType;

class PresentationController
{
    protected $twig;
    protected $formFactory;
    protected $domainManager;
    protected $presentationFactory;

    public function __construct($twig, $formFactory, $manager)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->domainManager = $manager;
    }

    /**
     * @param mixed $presentationFactory
     */
    public function setPresentationFactory($presentationFactory)
    {
        $this->presentationFactory = $presentationFactory;
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

        if ($request->isMethod('POST') && $form->handleRequest($request) && $form->isValid()) {
            $presentation = $this->presentationFactory->create($form->getData());
            $this->domainManager->create($presentation);
        }

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