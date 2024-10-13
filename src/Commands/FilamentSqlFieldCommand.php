<?php

namespace Saade\FilamentSqlField\Commands;

use Illuminate\Console\Command;

class FilamentSqlFieldCommand extends Command
{
    public $signature = 'filament-sql-field';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
