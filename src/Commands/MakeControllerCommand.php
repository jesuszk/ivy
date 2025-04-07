<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;

class MakeControllerCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName('make:controller')
            ->setDescription('Create a new controller')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the controller (singular form)')
            ->addOption('crud', null, InputOption::VALUE_NONE, 'Create CRUD methods');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $name = strtolower($input->getArgument('name'));
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $isCrud = $input->getOption('crud');

        $controllerName = ucfirst($name) . 'Controller';
        $serviceName = ucfirst($name) . 'Service';
        $filePath = __DIR__ . "/../controllers/{$controllerName}.php";

        if (file_exists($filePath)) {
            $io->error("Controller {$controllerName} already exists!");
            return Command::FAILURE;
        }

        $content = "<?php\n\n";
        $content .= "namespace src\Controllers;\n\n";
        $content .= "use src\Services\\{$serviceName};\n";
        $content .= "use src\Support\View;\n\n";
        $content .= "class {$controllerName}\n";
        $content .= "{\n";
        $content .= "    public function __construct(private {$serviceName} \${$name}Service)\n";
        $content .= "    {\n";
        $content .= "    }\n\n";

        if ($isCrud) {
            // Index method
            $content .= "    public function index()\n";
            $content .= "    {\n";
            $content .= "        \${$plural} = \$this->{$name}Service->getAll();\n";
            $content .= "        return View::render('{$plural}.index', ['{$plural}' => \${$plural}]);\n";
            $content .= "    }\n\n";

            // Create method
            $content .= "    public function create()\n";
            $content .= "    {\n";
            $content .= "        return View::render('{$plural}.create');\n";
            $content .= "    }\n\n";

            // Store method
            $content .= "    public function store()\n";
            $content .= "    {\n";
            $content .= "        \$data = \$_POST;\n";
            $content .= "        \$this->{$name}Service->create(\$data);\n";
            $content .= "        return header('Location: /{$plural}');\n";
            $content .= "    }\n\n";

            // Show method
            $content .= "    public function show(string \$uuid)\n";
            $content .= "    {\n";
            $content .= "        \${$name} = \$this->{$name}Service->getByUuid(\$uuid);\n";
            $content .= "        return View::render('{$plural}.show', ['{$name}' => \${$name}]);\n";
            $content .= "    }\n\n";

            // Edit method
            $content .= "    public function edit(string \$uuid)\n";
            $content .= "    {\n";
            $content .= "        \${$name} = \$this->{$name}Service->getByUuid(\$uuid);\n";
            $content .= "        return View::render('{$plural}.edit', ['{$name}' => \${$name}]);\n";
            $content .= "    }\n\n";

            // Update method
            $content .= "    public function update(string \$uuid)\n";
            $content .= "    {\n";
            $content .= "        \$data = \$_POST;\n";
            $content .= "        \$this->{$name}Service->update(\$uuid, \$data);\n";
            $content .= "        return header('Location: /{$plural}');\n";
            $content .= "    }\n\n";

            // Delete method
            $content .= "    public function destroy(string \$uuid)\n";
            $content .= "    {\n";
            $content .= "        \$this->{$name}Service->delete(\$uuid);\n";
            $content .= "        return header('Location: /{$plural}');\n";
            $content .= "    }\n";
        }

        $content .= "}\n";

        if (!is_dir(dirname($filePath))) {
            mkdir(dirname($filePath), 0777, true);
        }

        file_put_contents($filePath, $content);
        $io->success("Controller {$controllerName} created successfully!");

        return Command::SUCCESS;
    }

    private function runCommand($commandName, $name, OutputInterface $output, $options = [])
    {
        // Obtém a aplicação para executar o comando
        $application = $this->getApplication();
        $command = $application->find($commandName);

        // Cria o ArrayInput com o nome e as opções
        $inputArgs = ['command' => $commandName, 'name' => $name];
        $inputArgs = array_merge($inputArgs, $options);

        // Cria o ArrayInput com os parâmetros passados
        $input = new ArrayInput($inputArgs);

        // Executa o comando
        $command->run($input, $output);
    }

    private function pluralize($word)
    {
        // Método simples para pluralizar a palavra
        // Isso pode ser mais complexo dependendo do idioma
        return $word . 's';  // Plural básico, para exemplo
    }
}
