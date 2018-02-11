<?php

namespace System\Cli\Panther\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use System\Cli\Panther\Services\ControllerService;

class ControllerCommand extends Command
{

	private $controllerService;

	public function __construct()
    {
        $this->controllerService = new ControllerService();

        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('make:controller')
        	 ->addArgument('controller_name', InputArgument::REQUIRED, 'Controller Name')
        	 ->setDescription('Creates a new controller.')
        	 ->setHelp('This command allows you to create a controller...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln([
        	'',
        	'Creating controller `'.$input->getArgument('controller_name').'` ...',
        	''
        ]);

        $this->controllerService->create($input->getArgument('controller_name'));

        $output->writeln([
        	'Controller created successfully!',
        	''
        ]);
    }
}