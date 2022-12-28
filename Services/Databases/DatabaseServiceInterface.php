<?php

namespace Modules\Eloel\Services\Databases;

interface DatabaseServiceInterface
{
    /**
     * Creates a database.
     *
     * Drops the existing database and recreates from scratch
     *
     * @param string $dbName
     */
    public function createDatabase(string $dbName);
}
