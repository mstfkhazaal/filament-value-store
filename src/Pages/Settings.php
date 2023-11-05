<?php

namespace Mstfkhazaal\FilamentValueStore\Pages;

use Exception;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Validation\ValidationException;
use Spatie\Valuestore\Valuestore;

class Settings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static string $view = 'filament-value-store::pages.settings';
    public array $data;

    public static function getNavigationGroup(): ?string
    {
        return __(config('filament-value-store.group'));
    }

    public static function getNavigationLabel(): string
    {
        return __(config('filament-value-store.label'));
    }

    public static function shouldRegisterNavigation(): bool
    {
        if (method_exists(auth()->user(), 'canManageSettings')) {
            return auth()->user()?->canManageSettings() ?? true;
        } else {
            return false;
        }

    }

    public function getFormStatePath(): string
    {
        return 'data';
    }

    public function getFormSchema(): array
    {
        return filament('filament-value-store')->fields;
    }

    public function mount(): void
    {

        $this->form->fill(
            [...filament('filament-value-store')->default,
                ...Valuestore::make(
                    config('filament-value-store.path')
                )->all()]
        );
    }

    /**
     * @throws ValidationException
     */
    public function submit(): void
    {
        try {
            $this->validate();
            foreach ($this->data as $key => $data) {
                Valuestore::make(
                    config('filament-value-store.path')
                )->put($key, $data);
            }
            if (isset(filament('filament-value-store')->afterSave)) {
                $function = filament('filament-value-store')->afterSave;
                $function();
            }
            Notification::make()
                ->title(trans('Saved!'))
                ->success()
                ->send();
        } catch (Exception $e) {
            Notification::make()
                ->title($e->getMessage())
                ->danger()
                ->send();
        }

    }

    public function getTitle(): string
    {

        return __(config("filament-value-store.title"));
    }
}
