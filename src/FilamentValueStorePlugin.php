<?php

namespace Mstfkhazaal\FilamentValueStore;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Mstfkhazaal\FilamentValueStore\Pages\Settings;

class FilamentValueStorePlugin implements Plugin
{
    public $afterSave;
    public array $fields = [];
    public array $default = [];


    public static function make(): static
    {
        return app(static::class);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-value-store';
    }

    public function setFormFields(array $fields): static
    {
        $this->fields = $fields;
        return $this;
    }

    public function setAfterSave($function): static
    {
        $this->afterSave = $function;
        return $this;
    }

    public function setDefaultFields(array $default): static
    {
        $this->default = $default;
        return $this;
    }

    public function getDefaultFields(): array
    {
        return $this->default ?? [];
    }

    public function getFormFields(): array
    {
        return $this->fields ?? [];
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Settings::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }


}
