<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\ArrayAdapter;
use Web\Form\Type\PresentationType;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Gaufrette\StreamWrapper;

class PresentationController
{
    protected $twig;
    protected $formFactory;
    protected $domainManager;
    protected $presentationFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    public function __construct($twig, $formFactory, $manager, $filesystem)
    {
        $this->twig = $twig;
        $this->formFactory = $formFactory;
        $this->domainManager = $manager;
        $this->filesystem = $filesystem;
    }

    public function showAction(Request $request)
    {
        $path = '/1e/fc/32571be34f3089a6fb78111ee035.mp4';

        $filesystem = $this->filesystem;

        return new StreamedResponse(
            function () use ($path, $filesystem) {
                $map = StreamWrapper::getFilesystemMap();
                $map->set('stream', $filesystem);
                StreamWrapper::register();
                readfile('gaufrette://stream'.$path);
            }, 200, array('Content-Type' => $filesystem->mimeType($path))
        );
    }

    public function indexAction(Request $request)
    {
        $presentations = array();
        for ($i = 0;$i <= 25; $i++)
        {
            $presentation = array(
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eget nisi sed nulla gravida elementum. Integer molestie, quam sit amet dapibus faucibus, tortor nunc tempus risus, vel tristique velit dui a elit. Vivamus sed vestibulum lectus. Cras eget eros lorem. Ut volutpat ligula non egestas suscipit. Curabitur metus diam, efficitur sed nunc non, pharetra luctus ex. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque mattis nulla tellus, et iaculis libero vehicula vel. Sed feugiat arcu mauris, sit amet malesuada lectus ullamcorper ac. In in tempus ligula, in efficitur ligula. Vestibulum pellentesque a orci et fermentum. Sed semper, massa nec laoreet rhoncus, lorem turpis faucibus magna, nec tristique nisl odio id neque. Mauris at ex ac felis placerat blandit. In eu facilisis mauris.

Praesent gravida est et mi aliquam, nec porta dolor consectetur. Vivamus elementum sodales dui, ac hendrerit orci vehicula semper. Cras eget magna justo. Vestibulum sollicitudin varius justo nec sagittis. Pellentesque lobortis sem purus. Duis porta velit et quam ornare, non mattis purus pretium. Suspendisse potenti. Cras nibh tellus, fermentum in justo consequat, scelerisque venenatis augue. Duis vulputate dui dignissim quam imperdiet iaculis facilisis sed sapien.

Fusce imperdiet pretium magna, ornare lacinia mi. Vestibulum sit amet mauris vitae nunc pellentesque condimentum eget sed velit. Integer ut turpis interdum, venenatis magna vel, vestibulum nunc. Vestibulum venenatis mauris eros, non fringilla eros viverra ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam risus enim, rutrum sit amet ultrices sit amet, venenatis sed nibh. Nulla id felis sodales, iaculis purus et, commodo arcu. Nunc nec est eu risus semper pharetra. Ut a quam urna. Pellentesque porta id ipsum non tincidunt. Integer egestas justo sit amet sollicitudin sollicitudin. Quisque finibus enim vel rutrum consectetur. Suspendisse quis velit sed tortor rhoncus condimentum.

Morbi in lorem a mauris scelerisque tristique. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis a arcu sed lectus condimentum molestie. Sed mattis mi eu nunc pulvinar tempus. Proin lorem erat, auctor et ante laoreet, scelerisque dignissim turpis. Duis sed congue turpis. Nunc id nisl sed est vehicula dictum. Nulla nunc urna, cursus a iaculis quis, posuere a est. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla facilisi. Donec mollis, turpis ac facilisis scelerisque, neque mauris fringilla velit, et pharetra magna ipsum non urna. Aliquam enim magna, laoreet vel fermentum quis, mollis at dolor.

Ut erat erat, faucibus sit amet nulla at, lacinia interdum quam. Quisque quis sapien commodo, convallis purus nec, viverra risus. Praesent varius blandit nulla, id lacinia velit sollicitudin eget. Aenean odio purus, fringilla non sapien imperdiet, cursus euismod risus. Sed faucibus, justo at elementum hendrerit, mauris mi condimentum quam, quis consequat nisl dolor sed nulla. In eget est sed diam euismod blandit vitae tristique quam. Suspendisse iaculis enim vulputate egestas facilisis. Aenean scelerisque faucibus tellus, vel consequat erat vestibulum sit amet.', 
                'title' => 'prezentacja', 
                'author' => 'ja'
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
}