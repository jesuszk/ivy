<?php

namespace src\commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ViewIndexCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('view:index')
            ->setDescription('Create a new index view file')
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the view (singular form)')
            ->addOption('withTable', 't', InputOption::VALUE_NONE, 'Include table view in the index page');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $name = strtolower($input->getArgument('name'));
        $plural = substr($name, -1) === 'y' ? substr($name, 0, -1) . 'ies' : $name . 's';
        $directory = __DIR__ . "/../views/{$plural}";

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $filename = "{$directory}/index.php";

        // Read fields from JSON file
        $fieldsFile = __DIR__ . "/../views/{$plural}/fields.json";

        if (!file_exists($fieldsFile)) {
            $output->writeln("<error>Fields configuration file not found at: {$fieldsFile}</error>");
            $output->writeln("<info>Please create a fields.json file with the following structure:</info>");
            $output->writeln('[
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

        $fieldsJson = file_get_contents($fieldsFile);
        $fields = json_decode($fieldsJson, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $output->writeln("<error>Invalid JSON format in fields.json. Error: " . json_last_error_msg() . "</error>");
            return Command::FAILURE;
        }

        $content = $this->generateIndexContent(
            $name,
            $plural,
            $fields,
            $input->getOption('withTable')
        );

        file_put_contents($filename, $content);

        $output->writeln("<info>Index view created successfully at {$filename}</info>");
        return Command::SUCCESS;
    }

    private function generateIndexContent(
        string $name,
        string $plural,
        array $fields,
        bool $withTable
    ): string {
        // Generate layout parameters
        $layoutParams = [
            'title' => ucfirst($plural),
            'cardTitle' => ucfirst($plural)
        ];

        if ($withTable) {
            $layoutParams['css'] = 'path()->css("/table-responsive.css")';
        }

        $content = "<?= \$this->layout('templates/base', " . $this->arrayToPhpString($layoutParams) . ") ?>\n\n";

        // Generate form
        $content .= "<form action=\"<?= route('{$plural}.store'); ?>\" method=\"post\">\n";
        $content .= "    <div class=\"row g-3\">\n";

        foreach ($fields as $field) {
            $fieldName = $field['name'];
            $fieldType = $field['type'];
            $isRequired = $field['required'] ?? false;
            $requiredSpan = $isRequired ? ' <span class="">*</span>' : '';
            $colSize = $field['col_size'] ?? 'col-12 col-md-4';

            $content .= "        <div class=\"{$colSize}\">\n";
            $content .= "            <label for=\"{$fieldName}\" class=\"form-label fw-bold\">" . ucfirst(str_replace('_', ' ', $fieldName)) . "{$requiredSpan}</label>\n";

            if ($fieldType === 'select') {
                $content .= "            <select name=\"{$fieldName}\" id=\"{$fieldName}\" class=\"form-select\">\n";
                foreach ($field['options'] as $option) {
                    $content .= "                <option value=\"{$option['value']}\">{$option['label']}</option>\n";
                }
                $content .= "            </select>\n";
            } else {
                $inputType = $this->getInputType($fieldType);
                $content .= "            <input type=\"{$inputType}\" class=\"form-control\" name=\"{$fieldName}\" id=\"{$fieldName}\"";
                if (isset($field['step'])) {
                    $content .= " step=\"{$field['step']}\"";
                }
                if (isset($field['placeholder'])) {
                    $content .= " placeholder=\"{$field['placeholder']}\"";
                }
                $content .= ">\n";
            }

            $content .= "        </div>\n";
        }

        $content .= "        <div class=\"col-12\">\n";
        $content .= "            <button class=\"btn btn-company float-end\">Create <i class=\"ph ph-paper-plane-tilt\"></i></button>\n";
        $content .= "        </div>\n";
        $content .= "    </div>\n";
        $content .= "</form>\n\n";

        // Include table if requested
        if ($withTable) {
            $content .= "<?php \$this->insert('{$plural}/table', ['{$plural}' => \${$plural}]) ?>\n";
        }

        return $content;
    }

    private function getInputType(string $fieldType): string
    {
        $typeMap = [
            'text' => 'text',
            'number' => 'number',
            'email' => 'email',
            'password' => 'password',
            'date' => 'date',
            'datetime' => 'datetime-local',
            'textarea' => 'textarea',
            'checkbox' => 'checkbox',
            'radio' => 'radio',
            'file' => 'file',
            'hidden' => 'hidden',
            'tel' => 'tel',
            'url' => 'url',
            'color' => 'color',
            'range' => 'range',
            'search' => 'search',
            'time' => 'time',
            'week' => 'week',
            'month' => 'month'
        ];

        return $typeMap[$fieldType] ?? 'text';
    }

    private function arrayToPhpString(array $array): string
    {
        $result = "[\n";
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result .= "    'styles' => [\n";
                foreach ($value as $item) {
                    if ($key === 'css') {
                        $result .= "        {$item},\n";
                    } else
                        $result .= "        '{$item}',\n";
                }
                $result .= "    ],\n";
            } else {
                if ($key === 'css') {
                    $result .= "    'styles' => [{$value}],\n";
                } else
                    $result .= "    '{$key}' => '{$value}',\n";
            }
        }
        $result .= "]";
        return $result;
    }
}
