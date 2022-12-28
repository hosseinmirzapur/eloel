<?php


namespace Modules\Eloel\Services\Databases;


use Illuminate\Support\Facades\Schema;
use Modules\Eloel\Services\EloelService;

class DatabaseService extends EloelService implements DatabaseServiceInterface
{
    /**
     * Creates a database.
     *
     * Drops the existing database and recreates from scratch
     *
     * @param string $dbName
     */
    public function createDatabase(string $dbName)
    {
        $this->checkDatabase($dbName);
        Schema::createDatabase($dbName);
    }
}
