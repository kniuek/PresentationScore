<?php
/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 06/03/15
 * Time: 22:52
 */

namespace Kni\Domain\DomainManager;

use Symfony\Component\EventDispatcher\GenericEvent;

class AbstractManager
{
    protected $eventDispatcher;
    protected $manager;

    public function __construct($manager, $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->manager = $manager;
    }

    /**
     * @param object $resource
     *
     * @return object|ResourceEvent|null
     */
    public function create($resource)
    {
        $this->dispatchEvent($this->getEventName('pre_create'), new GenericEvent($resource));

//        $this->manager->persist($resource);
//        $this->manager->flush();

        $this->dispatchEvent($this->getEventName('post_create'), new GenericEvent($resource));

        return $resource;
    }

    /**
     * @param object $resource
     *
     * @return object|ResourceEvent|null
     */
    public function update($resource)
    {
        $this->dispatchEvent($this->getEventName('pre_update'), new GenericEvent($resource));

        $this->manager->persist($resource);
        $this->manager->flush();

        $this->dispatchEvent($this->getEventName('post_update'), new GenericEvent($resource));

        return $resource;
    }

    /**
     * @param object $resource
     *
     * @return object|ResourceEvent|null
     */
    public function delete($resource)
    {
        $this->dispatchEvent($this->getEventName('pre_delete'), new GenericEvent($resource));

        $this->manager->persist($resource);
        $this->manager->flush();

        $this->dispatchEvent($this->getEventName('post_delete'), new GenericEvent($resource));

        return $resource;
    }

    public function dispatchEvent($name, GenericEvent $event)
    {
        $this->eventDispatcher->dispatch($name, $event);
    }

    protected function getResourceName()
    {
        return 'object';
    }

    protected function getEventName($action)
    {
        return sprintf('resource.%s.%s', $this->getResourceName(), $action);
    }
}