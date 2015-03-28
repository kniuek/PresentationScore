<?php

namespace Storage\Uploader;

use Gaufrette\Filesystem;
use Storage\Model\FileAwareInterface;

class Uploader
{
    protected $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function upload(FileAwareInterface $object)
    {
        if (!$object->hasFile()) {
            return;
        }

        if (null !== $object->getPath()) {
            $this->remove($object->getPath());
        }

        do {
            $hash = md5(uniqid(mt_rand(), true));
            $path = $this->expandPath($hash.'.'.$object->getFile()->guessExtension());
        } while ($this->filesystem->has($path));

        $object->setPath($path);

        $this->filesystem->write(
            $object->getPath(),
            file_get_contents($object->getFile()->getPathname())
        );
    }

    public function remove($path)
    {
        return $this->filesystem->delete($path);
    }

    private function expandPath($path)
    {
        return sprintf(
            '%s/%s/%s',
            substr($path, 0, 2),
            substr($path, 2, 2),
            substr($path, 4)
        );
    }
}