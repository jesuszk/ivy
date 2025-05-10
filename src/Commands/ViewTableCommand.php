<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ViewTableCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('view:table')
            ->setDescription('Create a new table view file')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the table view')
            ->addArgument('columns', InputArgument::OPTIONAL, 'Comma-separated list of column names (e.g. "name,price,quantity")');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = strtolower($input->getArgument('name'));
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $directory = __DIR__ . "/../views/{$plural}";
        
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filename = "{$directory}/table.php";
        
        // Get columns from argument or use defaults
        $columnsInput = $input->getArgument('columns');
        $columns = $columnsInput ? explode(',', $columnsInput) : [
            'name',
            'price',
            'quantity',
            'control_stock',
            'value_min',
            'above_min',
            'actions'
        ];

        // Generate table header
        $header = "<thead>\n    <tr>\n";
        foreach ($columns as $column) {
            $header .= "        <th>" . ucfirst(str_replace('_', ' ', $column)) . "</th>\n";
        }
        $header .= "    </tr>\n</thead>";

        // Generate table body
        $body = "<tbody>\n    <?php if (\${$plural}) : ?>\n";
        $body .= "        <?php foreach (\${$plural} as \${$name}) : ?>\n";
        $body .= "            <tr>\n";
        
        foreach ($columns as $column) {
            if ($column === 'actions') {
                $body .= "                <td>\n";
                $body .= "                    <a href=\"<?= route('{$plural}.edit', ['uuid' => \${$name}->uuid]); ?>\" class=\"btn btn-primary\">Edit</a>\n";
                $body .= "                    <a href=\"<?= route('{$plural}.delete', ['uuid' => \${$name}->uuid]); ?>\" class=\"btn btn-danger\">Delete</a>\n";
                $body .= "                </td>\n";
            } else {
                $body .= "                <td><?= \${$name}->{$column}; ?></td>\n";
            }
        }
        
        $body .= "            </tr>\n";
        $body .= "        <?php endforeach; ?>\n";
        $body .= "    <?php else : ?>\n";
        $body .= "        <tr>\n";
        $body .= "            <td colspan=\"" . count($columns) . "\" class=\"text-center\">No {$plural} found 😟</td>\n";
        $body .= "        </tr>\n";
        $body .= "    <?php endif; ?>\n";
        $body .= "</tbody>";

        $content = "<table class=\"table-responsive my-3\">\n{$header}\n{$body}\n</table>";

        file_put_contents($filename, $content);

        $output->writeln("<info>Table view created successfully at {$filename}</info>");

        return Command::SUCCESS;
    }
}