<?php
/**
 * This file is part of the "Silex-Skeleton" project.
 * @author Jakub Kanclerz <kuba.kanclerz@creativestyle.pl>
 * Feel free to contact me
 */
namespace Kni\Fixtures\Command;

use Kni\Presentation\Model\Presentation;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class LoadFixturesCommand extends Command
{
    protected $app;

    protected function configure()
    {
        $this
            ->setName('load:fixtures')
            ->setDescription('Load test data')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $presentation = new Presentation();
        $presentation->setTitle('My Title');
        $presentation->setDescription('My Description');
        $presentation->setPath('/1e/fc/32571be34f3089a6fb78111ee035.mp4');

        $this->app['kni.manager.presentation']->create($presentation);

        $presentation = new Presentation();
        $presentation->setTitle('My Title 1');
        $presentation->setDescription('My Description 1');
        $presentation->setPath('/1e/fc/32571be34f3089a6fb78111ee035.mp4');

        $this->app['kni.manager.presentation']->create($presentation);
    }

    public function setApp($app)
    {
        $this->app = $app;
    }
}