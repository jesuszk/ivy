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
            ->addOption('crud', null, InputOption::VALUE_NONE, 'Create CRUD methods')
            ->addOption('full', 'f', InputOption::VALUE_NONE, 'Create full CRUD including requests');
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

        // Criar requests apenas se --full for passado
        if ($isCrud) {
            // Verificar se o fields.json existe
            $fieldsPath = __DIR__ . "/../views/{$plural}/fields.json";
            if (!file_exists($fieldsPath)) {
                $io->error("Fields configuration file not found at: {$fieldsPath}");
                return Command::FAILURE;
            }

            // Ler o fields.json
            $fields = json_decode(file_get_contents($fieldsPath), true);
            if (!$fields) {
                $io->error("Invalid fields.json file");
                return Command::FAILURE;
            }

            // Criar os requests
            $this->createRequests($name, $fields, $io);
        }

        $content = "<?php\n\n";
        $content .= "namespace src\Controllers;\n\n";
        $content .= "use src\Services\\{$serviceName};\n";
        $content .= "use src\Support\View;\n\n";
        $content .= "use src\Support\Redirect;\n\n";
        
        // Adicionar imports dos requests apenas se --full for passado
        if ($isCrud) {
            $namePlural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
            $nameUcFirst = ucfirst($name);
            $content .= "use src\\requests\\{$namePlural}\\{$nameUcFirst}StoreRequest;\n";
            $content .= "use src\\requests\\{$namePlural}\\{$nameUcFirst}UpdateRequest;\n\n";
        }
        
        $content .= "class {$controllerName}\n";
        $content .= "{\n";
        $content .= "    public function __construct(private {$serviceName} \${$name}Service)\n";
        $content .= "    {\n";
        $content .= "    }\n\n";

        if ($isCrud) {
            $nameUcFirst = ucfirst($name);
            // Index method
            $content .= "    public function index(): View\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \${$plural} = \$this->{$name}Service->getAll();\n";
            $content .= "            return view('{$plural}.index', ['{$plural}' => \${$plural}]);\n";
            $content .= "        } catch (\\Exception \$e) {\n";
            $content .= "            notification()->error(\$e->getMessage());\n";
            $content .= "            return view('{$plural}.index', ['{$plural}' => []]);\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Create method
            $content .= "    public function create()\n";
            $content .= "    {\n";
            $content .= "        return View::render('{$plural}.create');\n";
            $content .= "    }\n\n";

            // Store method
            $content .= "    public function store(" . ($isCrud ? "{$nameUcFirst}StoreRequest" : "array") . " \$request): Redirect\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \$this->{$name}Service->create(\$request->get());\n";
            $content .= "            return redirect()->route('{$plural}.index')->withSuccess('{$name} created successfully');\n";
            $content .= "        } catch (\\Exception \$e) {\n";
            $content .= "            return redirect()->route('{$plural}.index')->withError(\$e->getMessage());\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Show method
            $content .= "    public function show(string \$uuid)\n";
            $content .= "    {\n";
            $content .= "        \${$name} = \$this->{$name}Service->getByUuid(\$uuid);\n";
            $content .= "        return View::render('{$plural}.show', ['{$name}' => \${$name}]);\n";
            $content .= "    }\n\n";

            // Edit method
            $content .= "    public function edit(string \$uuid): View|Redirect\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \${$name} = \$this->{$name}Service->getByUuid(\$uuid);\n";
            $content .= "            return view('{$plural}.edit', ['{$name}' => \${$name}]);\n";
            $content .= "        } catch (\\Exception \$e) {\n";
            $content .= "            return redirect()->route('{$plural}.index')->withError(\$e->getMessage());\n";
            $content .= "        }\n";
            $content .= "    }\n\n";

            // Update method
            $content .= "    public function update(" . ($isCrud ? "{$nameUcFirst}UpdateRequest" : "array") . " \$request, string \$uuid): Redirect\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \$this->{$name}Service->update(\$uuid, \$request->get());\n";
            $content .= "            return redirect()->route('{$plural}.index')->withSuccess('{$name} updated successfully');\n";
            $content .= "        } catch (\\Exception \$e) {\n";
            $content .= "            return redirect()->route('{$plural}.index')->withError(\$e->getMessage());\n";
            $content .= "        }\n";
            $content .= "    }\n";

            // Delete method
            $content .= "    public function destroy(string \$uuid): Redirect\n";
            $content .= "    {\n";
            $content .= "        try {\n";
            $content .= "            \$this->{$name}Service->delete(\$uuid);\n";
            $content .= "            return redirect()->route('{$plural}.index')->withSuccess('{$name} deleted successfully');\n";
            $content .= "        } catch (\\Exception \$e) {\n";
            $content .= "            return redirect()->route('{$plural}.index')->withError(\$e->getMessage());\n";
            $content .= "        }\n";
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

    private function createRequests(string $name, array $fields, SymfonyStyle $io): void
    {
        $nameUcFirst = ucfirst($name);
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $pluralUcFirst = ucfirst($plural);
        $requestDir = __DIR__ . "/../requests/{$plural}";
        if (!is_dir($requestDir)) {
            mkdir($requestDir, 0777, true);
        }

        // Criar StoreRequest
        $storeRequestPath = "{$requestDir}/{$nameUcFirst}StoreRequest.php";
        if (!file_exists($storeRequestPath)) {
            $storeContent = "<?php\n\n";
            $storeContent .= "namespace src\\requests\\{$plural};\n\n";
            $storeContent .= "use src\\requests\\Request;\n\n";
            $storeContent .= "class {$nameUcFirst}StoreRequest extends Request\n";
            $storeContent .= "{\n";
            $storeContent .= "    protected array \$rules = [\n";
            
            foreach ($fields as $field) {
                if (isset($field['required']) && $field['required']) {
                    $storeContent .= "        '{$field['name']}' => 'required',\n";
                }
            }
            
            $storeContent .= "    ];\n";
            $storeContent .= "}\n";

            file_put_contents($storeRequestPath, $storeContent);
            $io->text("Created {$name}StoreRequest");
        }

        // Criar UpdateRequest
        $updateRequestPath = "{$requestDir}/{$name}UpdateRequest.php";
        if (!file_exists($updateRequestPath)) {
            $updateContent = "<?php\n\n";
            $updateContent .= "namespace src\\requests\\{$plural};\n\n";
            $updateContent .= "use src\\requests\\Request;\n\n";
            $updateContent .= "class {$nameUcFirst}UpdateRequest extends Request\n";
            $updateContent .= "{\n";
            $updateContent .= "    protected array \$rules = [\n";
            
            foreach ($fields as $field) {
                if (isset($field['required']) && $field['required']) {
                    $updateContent .= "        '{$field['name']}' => 'required',\n";
                }
            }
            
            $updateContent .= "    ];\n";
            $updateContent .= "}\n";

            file_put_contents($updateRequestPath, $updateContent);
            $io->text("Created {$name}UpdateRequest");
        }
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
