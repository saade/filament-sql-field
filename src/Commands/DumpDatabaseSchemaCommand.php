<?php

namespace Saade\FilamentSqlField\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DumpDatabaseSchemaCommand extends Command
{
    public $signature = 'filament-sql-field:dump-database-schema';

    public $description = 'Dump the database schema to a file';

    public function handle(): int
    {
        if(Artisan::call('db:show --json') !== 0) {
            $this->error('Failed to dump database schema');
            return self::FAILURE;
        }

        $database = json_decode(Artisan::output(), true);

        $schema = [];

        foreach($database['tables'] as $table) {
            if(Artisan::call("db:table {$table['table']} --json") !== 0) {
                $this->error('Failed to dump table schema');

                return self::FAILURE;
            }

            $table = json_decode(Artisan::output(), true);

            $schema[$table['table']['name']] = array_map(
                fn (array $column) => $column['column'],
                $table['columns']
            );
        }

        if(!file_exists(storage_path('database'))) {
            mkdir(storage_path('database'));
        }

        file_put_contents(
            storage_path('database/schema.json'),
            json_encode($schema, JSON_PRETTY_PRINT)
        );

        return self::SUCCESS;
    }
}
