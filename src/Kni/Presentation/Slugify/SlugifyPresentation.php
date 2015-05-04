<?php

namespace Kni\Presentation\Slugify;

use Kni\Presentation\Model\Presentation;
use Cocur\Slugify\Slugify;
use Kni\Presentation\Repository\PresentationRepositoryInterface;


/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */

class SlugifyPresentation 
{
    protected $slugify;
    protected $repository;

    public function __construct(Slugify $slugify, PresentationRepositoryInterface $repository)
    {
        $this->slugify = $slugify;
        $this->repository = $repository;
    }

    public function slugify(Presentation $presentation)
    {
        $slug = $this->slugify->slugify($presentation->getTitle());

        $i = 1;

        while ($this->repository->existsWithSlug($slug)) {
            $slug = $this->slugify->slugify(sprintf('%s %s', $presentation->getTitle(), $i));
            $i++;
        }

        $presentation->setSlug($slug);
    }
}