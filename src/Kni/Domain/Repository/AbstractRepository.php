<?php
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */

namespace Kni\Domain\Repository;

abstract class AbstractRepository
{
    protected $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
    }

    abstract public function findAll();
}