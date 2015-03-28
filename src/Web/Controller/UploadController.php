<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Web\Form\Type\PresentationType;

class UploadController
{
    protected $domainManager;
    protected $fileFactory;

    public function __construct($manager, $fileFactory)
    {
        $this->domainManager = $manager;
        $this->fileFactory = $fileFactory;
    }

    public function uploadAction(Request $request)
    {
        if ($request->isMethod('POST')) {

            $data = [
                'file' => $request->files->get('file')
            ];
            $file = $this->fileFactory->create($data);
            $this->domainManager->create($file);
        }
        
        
        return new JsonResponse(null, JsonResponse::HTTP_OK);
    }
}