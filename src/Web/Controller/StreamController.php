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
        $path = '/1e/fc/32571be34f3089a6fb78111ee035.mp4';

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