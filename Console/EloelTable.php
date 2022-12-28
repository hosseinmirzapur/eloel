<?php

namespace Modules\Eloel\Console;

use Exception;
use Illuminate\Console\Command;
use Modules\Eloel\Services\Tables\TableServiceInterface;

class EloelTable extends Command
{
    protected TableServiceInterface $service;

    public function __construct(TableServiceInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'eloel:table';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Elegant Eloquent Table commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $table = $this->ask('Which table do you want to alter');
        $this->checkInput($table);
        $action = $this->choice('What action is on your mind', ['rename', 'remove']);
        $this->checkInput($action);
        $this->handleAction($action, $table);
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
     * Handle user's required action
     *
     * @param $action
     * @param $table
     */
    protected function handleAction($action, $table)
    {
        switch ($action) {
            case 'rename':
                $this->handleName($table);
                break;
            case 'remove':
                $this->handleRemove($table);
                break;
            default:
                $this->error("Unsupported action requested...");
                die();
        }
    }

    /**
     * Handle the name user selects for the table to alter
     *
     * @param $table
     */
    protected function handleName($table)
    {
        $name = $this->ask('What name do you choose for this table');
        $this->checkInput($name);
        try {
            $this->service->renameTable($table, $name);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    /**
     * Handle Removal of user's desired table
     *
     * @param $table
     */
    protected function handleRemove($table)
    {
        try {
            $this->service->removeTable($table);
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
