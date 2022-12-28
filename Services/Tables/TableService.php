<?php


namespace Modules\Eloel\Services\Tables;


use Exception;
use Illuminate\Support\Facades\Schema;
use Modules\Eloel\Services\EloelService;

class TableService extends EloelService implements TableServiceInterface
{
    /**
     * Drops a table from the schema
     *
     * @param string $table
     * @throws Exception
     */
    public function removeTable(string $table)
    {
        $this->checkTable($table);
        Schema::drop($table);
    }

    /**
     * Renames a table in the schema
     *
     * @param string $fromName
     * @param string $toName
     * @throws Exception
     */
    public function renameTable(string $fromName, string $toName)
    {
        $this->checkTable($fromName);
        Schema::rename($fromName, $toName);
    }
}
