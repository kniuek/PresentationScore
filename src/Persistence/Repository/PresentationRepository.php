<?php
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */

namespace Persistence\Repository;

use Kni\Domain\Repository\AbstractRepository;
use Kni\Presentation\Repository\PresentationRepositoryInterface;

class PresentationRepository extends AbstractRepository implements PresentationRepositoryInterface
{
    public function findAll()
    {
        return $this->manager->getAll();
    }

    public function findByUser()
    {
        // TODO: Implement findByUser() method.
    }
}