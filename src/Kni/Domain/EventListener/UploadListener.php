<?php

namespace Kni\Domain\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class UploadListener
{
    protected $uploader;

    function __construct($uploader)
    {
        $this->uploader = $uploader;
    }

    public function onSendPresentation(GenericEvent $event)
    {
        $subject = $event->getSubject();
        $this->uploader->upload($subject);
    }

}