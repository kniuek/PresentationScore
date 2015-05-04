<?php

namespace Web\Controller;

use Pagerfanta\Adapter\MongoAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Web\Form\Type\PresentationType;
use Kni\Presentation\Repository\PresentationRepositoryInterface;
use Web\Form\Type\CommentType;


class PresentationController
{
    protected $twig;
    protected $formFactory;
    protected $domainManager;
    protected $presentationFactory;
    protected $commentFactory;

    /**
     * @param mixed $commentFactory
     */
    public function setCommentFactory($commentFactory)
    {
        $this->commentFactory = $commentFactory;
        return $this;
    }

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
        $presentations->sort(['createdAt' => -1]);

        $adapter = new MongoAdapter($presentations);
        $paginator = new Pagerfanta($adapter);
        $paginator->setMaxPerPage(3);
        $paginator->setCurrentPage($request->query->get('page', 1));

        return new Response(
            $this->twig->render(
                'Presentation/index.html.twig',
                array(
                    'presentations' => $paginator->getCurrentPageResults(),
                    'paginator' => $paginator
                )
            )
        );
    }

    public function showAction(Request $request)
    {
        $presentation = $this->repository->findBySlug($request->get('slug'));
        $form = $this->formFactory->create(new CommentType());
        if ($request->isMethod('POST') && $form->handleRequest($request) && $form->isValid()) {
            $presentation = $this->presentationFactory->create($form->getData());
            $this->domainManager->create($presentation);
        }
        return new Response(
            $this->twig->render(
                'Presentation/show.html.twig',
                array(
                    'presentation' => $presentation, 
                    'form' => $form->createView()
                )
            )
        );
    }

    public function rateAction(Request $request)
    {
        $slug = $request->get('slug');
        $rate = $request->request->get('rate');

        $presentation = $this->repository->findBySlug($slug);

        $presentation->rate($rate);
        $this->domainManager->update($presentation);

        return new JsonResponse();
    }

    public function commentAction(Request $request)
    {
        $slug = $request->get('slug');

        $presentation = $this->repository->findBySlug($slug);

        $form = $this->formFactory->create(new CommentType());
        if ($request->isMethod('POST') && $form->handleRequest($request) && $form->isValid()) {
            $comment = $this->commentFactory->create($form->getData());
            $presentation->addComment($comment);
            $this->domainManager->update($presentation);
        }

        return new RedirectResponse($request->headers->get('referer'));
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

    protected function findBySlugOr404($slug)
    {}
}