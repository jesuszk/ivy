<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class MakeExceptionCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:exception')
            ->setDescription('Cria uma nova exception.')
            ->addArgument('name', InputArgument::REQUIRED, 'Nome da exception')
            ->addOption('message', null, InputOption::VALUE_OPTIONAL, 'Mensagem da exception')
            ->addOption('code', null, InputOption::VALUE_OPTIONAL, 'Código da exception (default: 500)')
            ->addOption('entity', null, InputOption::VALUE_OPTIONAL, 'Nome da entidade (default: products)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = $input->getArgument('name');
        $message = $input->getOption('message') ?? 'Ocorreu um erro';
        $code = $input->getOption('code') ?? '500';
        $entity = $input->getOption('entity') ?? 'products';

        // Determina o namespace baseado no nome da exception
        $namespace = 'src\\exceptions';
        $directory = __DIR__ . "/../exceptions";

        if (strpos($name, '/') !== false) {
            $parts = explode('/', $name);
            $className = array_pop($parts);
            $namespace .= '\\' . implode('\\', $parts);

            // Cria o diretório completo
            $subDirectory = implode('/', $parts);
            $directory .= '/' . $subDirectory;

            // Atualiza o nome para o nome da classe apenas
            $name = $className;
        }

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filename = "$directory/{$name}.php";

        if (file_exists($filename)) {
            $output->writeln("<error>Exception {$name} already exists</error>");
            return Command::FAILURE;
        }

        $template = <<<PHP
<?php

namespace {$namespace};

use Exception;
use src\\traits\LogException;

class {$name} extends Exception
{
    private string \$entity = '{$entity}';

    use LogException;

    function __construct(array \$content = [])
    {
        \$message = '{$message}';
        \$code = {$code};
        \$this->log(\$message, \$code, json_encode(\$content));
        return parent::__construct(\$message, \$code);
    }
}
PHP;

        file_put_contents($filename, $template);
        $output->writeln("<info>Exception {$name} created successfully!</info>");
        return Command::SUCCESS;
    }
}
