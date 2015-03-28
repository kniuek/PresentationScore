<?php

namespace Storage\Model;
/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 07/03/15
 * Time: 01:57
 */

interface FileAwareInterface
{
    public function getFile();
    public function hasFile();
    public function getPath();

}