<?php
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */
namespace Persistence;

interface ManagerInterface
{
    public function persist($object);
    public function flush();
    public function delete($object);
    public function setNamespace($collection);
}