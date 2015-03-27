<?php

namespace Persistence;
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */

class BaseMongoManager implements ManagerInterface
{
    /**
     * @var
     */
    protected $database;
    protected $collection;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function persist($object)
    {
        $this->getCollection()->insert($object->toArray());
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }

    public function delete($object)
    {
        // TODO: Implement delete() method.
    }

    protected function getCollection()
    {
        $db = $this->getDb();
        $collection = $this->database->{$this->collection};

        return $collection;
    }

    public function setNamespace($collection)
    {
        $this->collection = $collection;
        return $this;
    }
}
