<?php

namespace Modules\Eloel\Console;

use Exception;
use Illuminate\Console\Command;
use Modules\Eloel\Services\Databases\DatabaseServiceInterface;

class EloelDatabase extends Command
{
    protected DatabaseServiceInterface $service;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DatabaseServiceInterface $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'eloel:database';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Elegant Eloquent DB commands';

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        $dbName = $this->ask('Enter your desired database name');
        $this->checkInput($dbName);
        $this->handleDbCreation($dbName);
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
     * Handle database creation by user
     *
     * @param $dbName
     */
    protected function handleDbCreation($dbName)
    {
        try {
            $this->service->createDatabase($dbName);
        } catch (Exception $e) {
            $this->error($e->getMessage());
            die();
        }
    }


}
