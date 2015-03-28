<?php
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */

namespace Persistence\Repository;

use Kni\Domain\Repository\AbstractRepository;
use Kni\Presentation\Repository\PresentationRepositoryInterface;
use Kni\Domain\AbstractFactory\Hydrator;

class PresentationRepository extends AbstractRepository implements PresentationRepositoryInterface
{
    protected $factory;

    public function __construct($manager, $factory)
    {
        parent::__construct($manager);
        $this->factory = $factory;
    }
    public function findAll()
    {
        return $this->manager->getAll();
    }

    public function findByUser()
    {
        // TODO: Implement findByUser() method.
    }

    public function find($id)
    {
        $collection = $this->manager->getUnitOfWork()->getCollection();

        $object = $collection->findOne(['_id' => new \MongoId($id)]);
        $presentation = $this->factory->create($object);

        return $presentation;
    }
}