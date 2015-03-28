<?php

namespace Storage\Manager;

use Kni\Domain\DomainManager\AbstractManager;

/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 07/03/15
 * Time: 07:16
 */

class FileManager extends AbstractManager
{
    protected function getResourceName()
    {
        return 'file';
    }
}