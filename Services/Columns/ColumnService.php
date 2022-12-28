<?php


namespace Modules\Eloel\Services\Columns;


use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Modules\Eloel\Services\EloelService;
use function Termwind\render;

class ColumnService extends EloelService implements ColumnServiceInterface
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
    public function addRelation(string $fromTable, string $toTable, string $relationColumn = 'id', string $action = 'cascade')
    {
        $this->checkTable($fromTable);
        $this->checkTable($toTable);
        Schema::table($toTable, function (Blueprint $table) use ($fromTable, $toTable, $relationColumn, $action) {
            $table
                ->foreignId(Str::singular($fromTable) . '_' . $relationColumn)
                ->constrained($fromTable)
                ->onDelete($action)
                ->onUpdate($action);
        });
    }

    /**
     * Drops a certain column or a group of them, from a table
     *
     * @param string $table
     * @param array|string $columns
     * @throws Exception
     */
    public function removeColumns(string $table, array|string $columns)
    {
        foreach ($columns as $column) {
            $this->checkColumn($table, $column);
        }
        Schema::dropColumns($table, $columns);
    }

    /**
     * Returns the type of a column in a table
     *
     * @param string $table
     * @param string $column
     * @throws Exception
     */
    public function columnType(string $table, string $column)
    {
        $this->checkColumn($table, $column);
        $type = Schema::getColumnType($table, $column);
        render(<<<HTML
            <div class="py-1 ml-2">
                <div class="px-1 bg-blue-300 text-black">$column Type</div>
                <em class="ml-1">
                  $type
                </em>
            </div>
        HTML
        );
    }

    /**
     * Renames a certain column on the provided table
     *
     * @param string $table
     * @param string $fromName
     * @param string $toName
     * @throws Exception
     */
    public function renameColumn(string $table, string $fromName, string $toName)
    {
        $this->checkColumn($table, $fromName);
        Schema::table($table, function (Blueprint $table) use ($fromName, $toName) {
            $table->renameColumn($fromName, $toName);
        });
    }
}
