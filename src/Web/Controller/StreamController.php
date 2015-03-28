<?php

namespace Web\Controller;

use Symfony\Component\HttpFoundation\Request;
use Gaufrette\Filesystem;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Gaufrette\StreamWrapper;

class StreamController
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    public function __construct($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    public function streamAction(Request $request)
    {
        $path = $request->get('path');

        $filesystem = $this->filesystem;

        return new StreamedResponse(
            function () use ($path, $filesystem) {
                $map = StreamWrapper::getFilesystemMap();
                $map->set('stream', $filesystem);
                StreamWrapper::register();
                readfile('gaufrette://stream'.$path);
            }, 200, array('Content-Type' => $filesystem->mimeType($path))
        );
    }

}