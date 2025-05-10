<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeRepositoryCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:repository')
            ->setDescription('Create a new repository')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the repository (singular form)')
            ->addOption('crud', null, InputOption::VALUE_NONE, 'Create CRUD methods');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = strtolower($input->getArgument('name'));
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $isCrud = $input->getOption('crud');

        $repositoryName = ucfirst($name) . 'Repository';
        $filePath = __DIR__ . "/../repositories/{$repositoryName}.php";

        if (file_exists($filePath)) {
            $io->error("Repository {$repositoryName} already exists!");
            return Command::FAILURE;
        }

        $content = "<?php\n\n";
        $content .= "namespace src\\repositories;\n\n";
        $content .= "use src\\repositories\Querio;\n\n";
        $content .= "class {$repositoryName} extends Querio\n";
        $content .= "{\n";
        $content .= "    protected string \$table = '{$plural}';\n\n";

        if ($isCrud) {
          
        }

        $content .= "}\n";

        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        file_put_contents($filePath, $content);
        $io->success("Repository {$repositoryName} created successfully!");

        return Command::SUCCESS;
    }
}
