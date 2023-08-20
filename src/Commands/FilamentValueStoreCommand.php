<?php

namespace Mstfkhazaal\FilamentValueStore\Commands;

use Illuminate\Console\Command;

class FilamentValueStoreCommand extends Command
{
    public $signature = 'filament-value-store';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
