<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Web\Form\Type\PresentationType;
use Kni\Presentation\Repository\PresentationRepositoryInterface;


class PresentationController
{
    protected $twig;
    protected $formFactory;
    protected $domainManager;
    protected $presentationFactory;

    /**
     * @var PresentationRepositoryInterface
     */
    protected $repository;

    public function __construct($twig, $formFactory, $manager)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->domainManager = $manager;
    }

    public function indexAction(Request $request)
    {
        $presentations = array();

        $presentations = $this->repository->findAll();
        for ($i = 0;$i <= 25; $i++)
        {
            $presentation = array(
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget nisi sed nulla gravida elementum. Integer molestie, quam sit amet dapibus faucibus, tortor nunc tempus risus, vel tristique velit dui a elit. Vivamus sed vestibulum lectus. Cras eget eros lorem. Ut volutpat ligula non egestas suscipit. Curabitur metus diam, efficitur sed nunc non, pharetra luctus ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque mattis nulla tellus, et iaculis libero vehicula vel. Sed feugiat arcu mauris, sit amet malesuada lectus ullamcorper ac. In in tempus ligula, in efficitur ligula. Vestibulum pellentesque a orci et fermentum. Sed semper, massa nec laoreet rhoncus, lorem turpis faucibus magna, nec tristique nisl odio id neque. Mauris at ex ac felis placerat blandit. In eu facilisis mauris.

Praesent gravida est et mi aliquam, nec porta dolor consectetur. Vivamus elementum sodales dui, ac hendrerit orci vehicula semper.  ', 
                'title' => 'prezentacja', 
                'author' => 'ja',
                'file' => '../HTML5Video.mp4'
            );
            array_push($presentations, $presentation);
        }

        $adapter = new ArrayAdapter($presentations);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(3);
        $pagerfanta->setCurrentPage($request->query->get('page', 1));

        // $presentations
        //     ->getPaginatePresentations()
        //     ->setMaxPerPage(3)
        //     ->setCurrentPage($request->get('page')) 
        // ;

        return new Response(
            $this->twig->render(
                'Presentation/index.html.twig',
                array(
                    'pagerfanta' => $pagerfanta
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

    /**
     * @param mixed $presentationFactory
     */
    public function setPresentationFactory($presentationFactory)
    {
        $this->presentationFactory = $presentationFactory;
    }

    public function setRepository($repository)
    {
        $this->repository = $repository;
    }
}