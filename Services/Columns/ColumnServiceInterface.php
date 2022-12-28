<?php

namespace Modules\Eloel\Services\Columns;

use Exception;

interface ColumnServiceInterface
{
    /**
     * Add a relation from a table to another table using a custom column
     *
     * Tip: The action field can be one of these 3 actions: cascade, restrict, set null
     *
     * @param string $fromTable
     * @param string $toTable
     * @param string $relationColumn
     * @param string $action
     * @throws Exception
     */
    public function addRelation(string $fromTable, string $toTable, string $relationColumn = 'id', string $action = 'cascade');

    /**
     * Drops a certain column or a group of them, from a table
     *
     * @param string $table
     * @param array|string $columns
     * @throws Exception
     */
    public function removeColumns(string $table, array|string $columns);

    /**
     * Returns the type of a column in a table
     *
     * @param string $table
     * @param string $column
     * @throws Exception
     */
    public function columnType(string $table, string $column);

    /**
     * Renames a certain column on the provided table
     *
     * @param string $table
     * @param string $fromName
     * @param string $toName
     * @throws Exception
     */
    public function renameColumn(string $table, string $fromName, string $toName);
}
