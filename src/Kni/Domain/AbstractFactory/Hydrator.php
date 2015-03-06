<?php
/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 06/03/15
 * Time: 22:36
 */
namespace Kni\Domain\AbstractFactory;

use Symfony\Component\PropertyAccess\PropertyAccess;

class Hydrator
{
    public static function hydrate($object, $data)
    {
        $accessor = PropertyAccess::createPropertyAccessor();
        foreach ($data as $key => $value) {

            $accessor->setValue($object, $key, $value);
        }
    }
}
