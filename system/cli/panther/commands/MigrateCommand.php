<?php

namespace System\Cli\Panther\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

use System\Cli\Panther\Services\MigrationService;

class MigrateCommand extends Command
{

	private $migrationService;

	public function __construct()
    {
        $this->migrationService = new MigrationService();

        parent::__construct();
    }


    protected function configure()
    {
        $this->setName('migrate')
        	 ->addArgument('migration_name', InputArgument::OPTIONAL, 'Migration Name')
        	 ->setDescription('Execute migrations.')
        	 ->setHelp('This command allows you to execute a migration or migrations...');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $output->writeln([
        	'',
        	'Migration Started',
        	''
        ]);

        $outputLines = $this->migrationService->run($input->getArgument('migration_name'));
        $output->writeln($outputLines);


        $output->writeln([
            '',
        	'Migrated successfully!',
        	''
        ]);
    }
}