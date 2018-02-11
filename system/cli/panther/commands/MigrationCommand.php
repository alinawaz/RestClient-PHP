<?php

namespace System\Cli\Panther\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use System\Cli\Panther\Services\MigrationService;

class MigrationCommand extends Command
{

	private $migrationService;

	public function __construct()
    {
        $this->migrationService = new MigrationService();

        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('make:migration')
        	 ->addArgument('migration_name', InputArgument::REQUIRED, 'Migration Name')
             ->addArgument('table_name', InputArgument::REQUIRED, 'Table Name')
        	 ->setDescription('Creates a new migration.')
        	 ->setHelp('This command allows you to create a migration...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln([
        	'',
        	'Creating migration `'.$input->getArgument('migration_name').'` ...',
        	''
        ]);

        $this->migrationService->create($input->getArgument('migration_name'),$input->getArgument('table_name'));

        $output->writeln([
        	'Migration created successfully!',
        	''
        ]);
    }
}