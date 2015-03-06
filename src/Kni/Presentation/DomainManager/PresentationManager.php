<?php
/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 06/03/15
 * Time: 23:02
 */

namespace Kni\Presentation\DomainManager;

use Kni\Domain\DomainManager\AbstractManager;

class PresentationManager extends AbstractManager
{
    protected function getResourceName()
    {
        return 'presentation';
    }
}