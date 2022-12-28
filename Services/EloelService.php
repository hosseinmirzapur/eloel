<?php


namespace Modules\Eloel\Services;


use Exception;
use Illuminate\Support\Facades\Schema;

class EloelService
{
    /**
     * Checks if target table exists
     *
     * @param string $table
     * @throws Exception
     */
    protected function checkTable(string $table)
    {
        if (!Schema::hasTable($table)) {
            throw new Exception('Target table not found.');
        }
    }

    /**
     * Checks if target column exists on provided table
     *
     * @param $table
     * @param $column
     * @throws Exception
     */
    protected function checkColumn($table, $column)
    {
        $this->checkTable($table);
        if (!Schema::hasColumn($table, $column)) {
            throw new Exception('Target column not found on the provided table.');
        }
    }

    /**
     * Checks whether database exists
     *
     * @param string $dbName
     */
    protected function checkDatabase(string $dbName)
    {
        Schema::dropDatabaseIfExists($dbName);
    }
}
