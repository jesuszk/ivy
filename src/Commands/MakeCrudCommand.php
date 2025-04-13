<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeCrudCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:crud')
            ->setDescription('Create all CRUD views for a resource')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the resource (singular form)')
            ->addOption('full', 'f', InputOption::VALUE_NONE, 'Create full CRUD including controller, service and repository');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = strtolower($input->getArgument('name'));
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $isFull = $input->getOption('full');

        $io->title("Creating CRUD for {$plural}");

        // Create directory if it doesn't exist
        $directory = __DIR__ . "/../views/{$plural}";
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
            $io->text("Created directory: {$directory}");
        }

        // Check if fields.json exists
        $fieldsFile = "{$directory}/fields.json";
        if (!file_exists($fieldsFile)) {
            $io->error("Fields configuration file not found at: {$fieldsFile}");
            $io->text("Please create a fields.json file with the following structure:");
            $io->text('[
    {
        "name": "name",
        "type": "text",
        "required": true,
        "col_size": "col-12 col-md-4",
        "placeholder": "Name"
    },
    {
        "name": "price",
        "type": "number",
        "required": true,
        "col_size": "col-12 col-md-2",
        "placeholder": "Price"
    }
]');
            return Command::FAILURE;
        }

        // Create views
        $io->section("Creating views...");
        
        // Create index view
        $io->text("Creating index view...");
        $indexCommand = new ViewIndexCommand();
        $indexCommand->setApplication($this->getApplication());
        $indexInput = new \Symfony\Component\Console\Input\ArrayInput([
            'name' => $name,
            '--withTable' => true
        ]);
        $indexCommand->run($indexInput, $output);

        // Create table view
        $io->text("Creating table view...");
        $tableCommand = new ViewTableCommand();
        $tableCommand->setApplication($this->getApplication());
        $tableInput = new \Symfony\Component\Console\Input\ArrayInput([
            'name' => $name
        ]);
        $tableCommand->run($tableInput, $output);

        // Create edit view
        $io->text("Creating edit view...");
        $editCommand = new ViewEditCommand();
        $editCommand->setApplication($this->getApplication());
        $editInput = new \Symfony\Component\Console\Input\ArrayInput([
            'name' => $name
        ]);
        $editCommand->run($editInput, $output);

        if ($isFull) {
            // Create controller
            $io->section("Creating controller...");
            $controllerCommand = new MakeControllerCommand();
            $controllerCommand->setApplication($this->getApplication());
            $controllerInput = new \Symfony\Component\Console\Input\ArrayInput([
                'name' => $name,
                '--crud' => true
            ]);
            $controllerCommand->run($controllerInput, $output);

            // Create service
            $io->section("Creating service...");
            $serviceCommand = new MakeServiceCommand();
            $serviceCommand->setApplication($this->getApplication());
            $serviceInput = new \Symfony\Component\Console\Input\ArrayInput([
                'name' => $name,
                '--crud' => true
            ]);
            $serviceCommand->run($serviceInput, $output);

            // Create repository
            $io->section("Creating repository...");
            $repositoryCommand = new MakeRepositoryCommand();
            $repositoryCommand->setApplication($this->getApplication());
            $repositoryInput = new \Symfony\Component\Console\Input\ArrayInput([
                'name' => $name,
                '--crud' => true
            ]);
            $repositoryCommand->run($repositoryInput, $output);
        }

        $io->success("All CRUD components created successfully!");
        $io->text("Files created:");
        $files = [
            "{$directory}/index.php",
            "{$directory}/table.php",
            "{$directory}/edit.php"
        ];

        if ($isFull) {
            $files = array_merge($files, [
                "src/Controllers/" . ucfirst($plural) . "Controller.php",
                "src/Services/" . ucfirst($plural) . "Service.php",
                "src/Repositories/" . ucfirst($plural) . "Repository.php"
            ]);
        }

        $io->listing($files);

        return Command::SUCCESS;
    }
} 