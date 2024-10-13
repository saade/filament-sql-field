<?php
namespace Saade\FilamentSqlField\Forms\Components;

use Closure;
use Filament\Forms\Components\Field;

class SQLField extends Field {
    protected string $view = 'filament-sql-field::index';

    protected array|Closure|null $schema = null;

    public function schema(array|Closure|null $schema): static {
        $this->schema = $schema;

        return $this;
    }

    public function getSchema(): ?array
    {
        return $this->evaluate($this->schema);
    }
}