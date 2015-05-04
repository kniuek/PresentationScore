<?php

namespace Kni\Domain\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class SlugListener
{
    protected $presentationSlugifer;

    function __construct($presentationSlugifer)
    {
        $this->presentationSlugifer = $presentationSlugifer;
    }

    public function onCreatePresentation(GenericEvent $event)
    {
        $subject = $event->getSubject();
        $this->presentationSlugifer->slugify($subject);
    }

}