<?php

namespace Saade\FilamentSqlField;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilamentSqlFieldServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-sql-field';

    public static string $viewNamespace = 'filament-sql-field';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name);
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );
    }

    protected function getAssetPackageName(): ?string
    {
        return 'saade/filament-sql-field';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            AlpineComponent::make('filament-sql-field', __DIR__ . '/../resources/dist/filament-sql-field.js'),
            Css::make('filament-sql-field-styles', __DIR__ . '/../resources/dist/filament-sql-field.css'),
        ];
    }
}
