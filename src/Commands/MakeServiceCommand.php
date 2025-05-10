<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeServiceCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:service')
            ->setDescription('Create a new service')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the service (singular form)')
            ->addOption('crud', null, InputOption::VALUE_NONE, 'Create CRUD methods');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = strtolower($input->getArgument('name'));
        $nameUcFirst = ucfirst($name);
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $isCrud = $input->getOption('crud');

        $serviceName = ucfirst($name) . 'Service';
        $repositoryName = ucfirst($name) . 'Repository';
        $filePath = __DIR__ . "/../services/{$serviceName}.php";

        if (file_exists($filePath)) {
            $io->error("Service {$serviceName} already exists!");
            return Command::FAILURE;
        }

        $content = "<?php\n\n";
        $content .= "namespace src\Services;\n\n";
        $content .= "use Exception;\n";
        $content .= "use src\\exceptions\\{$plural}\\{$nameUcFirst}CreateFailedException;\n";
        $content .= "use src\\exceptions\\{$plural}\\{$nameUcFirst}DeleteFailedException;\n";
        $content .= "use src\\exceptions\\{$plural}\\{$nameUcFirst}GetAllFailedException;\n";
        $content .= "use src\\exceptions\\{$plural}\\{$nameUcFirst}GetByUuidException;\n";
        $content .= "use src\\exceptions\\{$plural}\\{$nameUcFirst}UpdateFailedException;\n";
        $content .= "use src\Repositories\\{$repositoryName};\n";
        $content .= "use stdClass;\n\n";
        $content .= "class {$serviceName}\n";
        $content .= "{\n";
        $content .= "    public function __construct(private {$repositoryName} \${$name}Repository) {}\n\n";

        if ($isCrud) {
            // Create method
            $content .= "    /**
     * Create a new {$name}
     *
     * @param array \$data The data to create the {$name}
     * @return array The created {$name}
     * @throws {$nameUcFirst}CreateFailedException If the creation fails
     */\n";
            $content .= "    public function create(array \$data): array\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \${$name} = \$this->{$name}Repository->create(\$data);\n";
            $content .= "            return \${$name};\n";
            $content .= "        } catch (Exception \$e) {\n";
            $content .= "            throw new {$nameUcFirst}CreateFailedException(\$data);\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Get all method
            $content .= "    /**
     * Get all {$plural}
     *
     * @return array The list of {$plural}
     * @throws {$nameUcFirst}GetAllFailedException If the retrieval fails
     */\n";
            $content .= "    public function getAll(): array\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            return \$this->{$name}Repository->getAll();\n";
            $content .= "        } catch (Exception \$e) {\n";
            $content .= "            throw new {$nameUcFirst}GetAllFailedException();\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Delete method
            $content .= "    /**
     * Delete a {$name} by UUID
     *
     * @param string \$uuid The UUID of the {$name} to delete
     * @throws {$nameUcFirst}DeleteFailedException If the deletion fails
     */\n";
            $content .= "    public function delete(string \$uuid): void\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \$this->{$name}Repository->deleteByUuid(\$uuid);\n";
            $content .= "        } catch (Exception \$e) {\n";
            $content .= "            throw new {$nameUcFirst}DeleteFailedException(['uuid' => \$uuid]);\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Get by UUID method
            $content .= "    /**
     * Get a {$name} by UUID
     *
     * @param string \$uuid The UUID of the {$name} to retrieve
     * @return stdClass|bool The {$name} or false if not found
     * @throws {$nameUcFirst}GetByUuidException If the retrieval fails
     */\n";
            $content .= "    public function getByUuid(string \$uuid): stdClass|bool\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \${$name} = \$this->{$name}Repository->getByUuid(\$uuid);\n";
            $content .= "            return \${$name};\n";
            $content .= "        } catch (Exception \$e) {\n";
            $content .= "            throw new {$nameUcFirst}GetByUuidException(['uuid' => \$uuid]);\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Update method
            $content .= "    /**
     * Update a {$name} by UUID
     *
     * @param string \$uuid The UUID of the {$name} to update
     * @param array \$data The data to update the {$name}
     * @return array The updated {$name}
     * @throws {$nameUcFirst}UpdateFailedException If the update fails
     */\n";
            $content .= "    public function update(string \$uuid, array \$data): array\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \${$name} = \$this->{$name}Repository->updateByUuid(\$uuid, \$data);\n";
            $content .= "            return \${$name};\n";
            $content .= "        } catch (Exception \$e) {\n";
            $content .= "            throw new {$nameUcFirst}UpdateFailedException(['uuid' => \$uuid]);\n";
            $content .= "        }\n";
            $content .= "    }\n";
        }

        $content .= "}\n";

        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        file_put_contents($filePath, $content);
        $io->success("Service {$serviceName} created successfully!");

        return Command::SUCCESS;
    }
}