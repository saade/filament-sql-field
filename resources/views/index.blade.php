<x-filament-forms::field-wrapper
    class="filament-sql-field"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
<div
    ax-load
    ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-sql-field', 'saade/filament-sql-field') }}"
    ax-load-css="{{ \Filament\Support\Facades\FilamentAsset::getStyleHref('filament-sql-field-styles', 'saade/filament-sql-field') }}"
    x-data="filamentSqlField({
        state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath()}')") }},
        schema: @js($getSchema())
    })"
>
    <div x-ref="editor"></div>
</div>
</x-filament-forms::field-wrapper>