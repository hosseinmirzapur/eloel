<?php

namespace Modules\Eloel\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Eloel\Console\EloelColumn;
use Modules\Eloel\Console\EloelDatabase;
use Modules\Eloel\Console\EloelTable;
use Modules\Eloel\Services\Columns\ColumnService;
use Modules\Eloel\Services\Columns\ColumnServiceInterface;
use Modules\Eloel\Services\Databases\DatabaseService;
use Modules\Eloel\Services\Databases\DatabaseServiceInterface;
use Modules\Eloel\Services\Tables\TableService;
use Modules\Eloel\Services\Tables\TableServiceInterface;

class EloelServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected string $moduleName = 'Eloel';

    public $singletons = [
        ColumnServiceInterface::class => ColumnService::class,
        TableServiceInterface::class => TableService::class,
        DatabaseServiceInterface::class => DatabaseService::class
    ];

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function registerCommands()
    {
        $this->commands([
            EloelColumn::class,
            EloelTable::class,
            EloelDatabase::class
        ]);
    }
}
