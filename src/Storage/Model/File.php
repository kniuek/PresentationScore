<?php
/**
 * Created by PhpStorm.
 * User: jkanclerz
 * Date: 07/03/15
 * Time: 07:02
 */

namespace Storage\Model;


class File implements FileAwareInterface
{
    protected $file;
    protected $path;

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    public function hasFile()
    {
        return $this->file !== null;
    }
}