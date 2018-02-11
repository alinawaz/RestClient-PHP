<?php

namespace System\Cli\Panther\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use System\Cli\Panther\Services\ModelService;

class ModelCommand extends Command
{

	private $modelService;

	public function __construct()
    {
        $this->modelService = new ModelService();

        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('make:model')
        	 ->addArgument('model_name', InputArgument::REQUIRED, 'Model Name')
             ->addArgument('table_name', InputArgument::REQUIRED, 'Table Name')
        	 ->setDescription('Creates a new model.')
        	 ->setHelp('This command allows you to create a model...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln([
        	'',
        	'Creating model `'.$input->getArgument('model_name').'` ...',
        	''
        ]);

        $this->modelService->create($input->getArgument('model_name'),$input->getArgument('table_name'));

        $output->writeln([
        	'Model created successfully!',
        	''
        ]);
    }
}