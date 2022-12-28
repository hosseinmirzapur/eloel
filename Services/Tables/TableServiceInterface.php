<?php

namespace Modules\Eloel\Services\Tables;

use Exception;

interface TableServiceInterface
{
    /**
     * Drops a table from the schema
     *
     * @param string $table
     * @throws Exception
     */
    public function removeTable(string $table);

    /**
     * Renames a table in the schema
     *
     * @param string $fromName
     * @param string $toName
     * @throws Exception
     */
    public function renameTable(string $fromName, string $toName);
}
