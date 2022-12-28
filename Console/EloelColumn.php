<?php

namespace Modules\Eloel\Console;

use Exception;
use Illuminate\Console\Command;
use Modules\Eloel\Services\Columns\ColumnServiceInterface;

class EloelColumn extends Command
{
    protected ColumnServiceInterface $service;
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'eloel:column';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Elegant Eloquent Column commands';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ColumnServiceInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @throws Exception
     */
    public function handle()
    {
        $action = $this->choice('what action do you have on mind', [
            'add-relation', 'remove-columns', 'column-type', 'rename-column'
        ]);
        switch ($action) {
            case 'add-relation':
                $this->addRelation();
                break;

            case 'remove-columns':
                $this->removeColumns();
                break;
            case 'column-type':
                $this->columnType();
                break;
            case 'rename-column':
                $this->renameColumn();
                break;
            default:
                $this->error('Unsupported action requested...');
        }
        $this->info('Command executed successfully');
    }

    /**
     * Check validation of console input
     *
     * @param $input
     * @param bool $hasDefault
     */
    protected function checkInput($input, bool $hasDefault = false)
    {
        if ((!isset($input) || $input == '' || $input == null) && !$hasDefault) {
            $this->error("Unsupported input given...");
            die();
        }
    }

    /**
     * Adds a relation between parent table and child table.
     *
     * @throws Exception
     */
    protected function addRelation()
    {
        $fromTable = $this->ask('Enter the name of the parent table');
        $this->checkInput($fromTable);
        $toTable = $this->ask('Enter the name of the child table');
        $this->checkInput($toTable);
        $relationColumn = $this->ask('Enter the column which is going to be referenced (default is \'id\')', 'id');
        $action = $this->choice('Action to  be taken for column (default is \'cascade\')', ['cascade', 'restrict', 'set null'], 'cascade');
        $this->service->addRelation($fromTable, $toTable, $relationColumn, $action);
    }

    /**
     * Removes Columns from a table.
     *
     * @throws Exception
     */
    protected function removeColumns()
    {
        $table = $this->ask('Enter the name of desired table');
        $this->checkInput($table);
        $columns = $this->ask('Enter your desired columns separated by space');
        $this->checkInput($columns);
        $separatedColumns = explode(' ', $columns);
        $this->service->removeColumns($table, $separatedColumns);
    }

    /**
     * Renders an HTML of the table's column type provided.
     *
     * @throws Exception
     */
    protected function columnType()
    {
        $table = $this->ask('Enter the name of desired table');
        $this->checkInput($table);
        $column = $this->ask('Enter the desired column');
        $this->checkInput($column);
        $this->service->columnType($table, $column);
    }

    /**
     * Renames a column of the provided table.
     *
     * @throws Exception
     */
    protected function renameColumn()
    {
        $table = $this->ask('Enter the name of desired table');
        $this->checkInput($table);
        $fromName = $this->ask('Enter the name of the column you want to change');
        $this->checkInput($fromName);
        $toName = $this->ask('Enter the name you desire your column to have');
        $this->checkInput($toName);
        $this->service->renameColumn($table, $fromName, $toName);
    }
}
