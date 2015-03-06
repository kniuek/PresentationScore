<?php
/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 06/03/15
 * Time: 22:32
 */

namespace Kni\Domain\AbstractFactory;

class AbstractFactory
{
    protected $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function create(array $data = array())
    {
        $object = new $this->class();

        $this->hydrateObject($object, $data);
    }

    protected function hydrateObject($object, $data)
    {
        Hydrator::hydrate($object, $data);
    }
}