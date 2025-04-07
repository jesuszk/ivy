<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class MakeRequestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:request')
            ->setDescription('Cria um novo request.')
            ->addArgument('name', InputArgument::REQUIRED, 'Nome do request')
            ->addOption('rules', null, InputOption::VALUE_OPTIONAL, 'Regras de validação separadas por vírgula (ex: name:required,price:required)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $rules = $input->getOption('rules');
        $directory = __DIR__ . "/../requests";
        $filename = "$directory/{$name}.php";

        $fileDirectory = dirname($filename);
        if (!is_dir($fileDirectory)) {
            if (!mkdir($fileDirectory, 0777, true)) {
                $output->writeln("<error>Failed to create directory: {$fileDirectory}</error>");
                return Command::FAILURE;
            }
        }

        if (file_exists($filename)) {
            $output->writeln("<error>Request {$name} already exists</error>");
            return Command::FAILURE;
        }

        $rulesArray = [];
        if ($rules) {
            $rulesParts = explode(',', $rules);
            foreach ($rulesParts as $rule) {
                $parts = explode(':', $rule);
                if (count($parts) === 2) {
                    $rulesArray[$parts[0]] = $parts[1];
                }
            }
        }

        $rulesString = $this->generateRulesString($rulesArray);
        $onlyName = substr($name, strrpos($name, '/') + 1) ?: $name;
        $namespace = 'src\\requests';
        if (strpos($name, '/') !== false) {
            $namespace .= '\\' . str_replace('/', '\\', dirname($name));
        }
        
        $template = <<<PHP
<?php

namespace {$namespace};

use src\\requests\\Request;

class {$onlyName} extends Request {
    protected array \$rules = [
{$rulesString}
    ];
}
PHP;

        file_put_contents($filename, $template);
        $output->writeln("<info>Request {$name} created successfully!</info>");
        return Command::SUCCESS;
    }

    private function generateRulesString(array $rules): string
    {
        if (empty($rules)) {
            return '';
        }

        $rulesString = '';
        foreach ($rules as $field => $rule) {
            $rulesString .= "        '{$field}' => '{$rule}',\n";
        }
        return rtrim($rulesString);
    }
}
