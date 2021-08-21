<?php

namespace App\Console\Commands;

use App\Imports\AbilitiesImport;
use App\Imports\FightersImport;
use App\Imports\RacesImport;
use App\Models\Ability;
use App\Models\Fighter;
use App\Models\Race;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

/**
 * Class ImportGameDataCommand
 *
 * @package App\Console\Commands
 */
class ImportGameDataCommand extends Command
{
    protected $signature = 'import:game';

    protected $description = 'Import game data from a series of Excel spreadsheets.';

    /**
     * Execute the console command.
     *
     * @throws \Throwable
     * @return void|never-return
     */
    public function handle(): void
    {
        try {
            $this->output->title('Starting import!');

            (new RacesImport())
                ->withOutput($this->output)
                ->import(config('game.imports.dir') . Race::IMPORT_SHEET);

            (new FightersImport())
                ->withOutput($this->output)
                ->import(config('game.imports.dir') . Fighter::IMPORT_SHEET);

            (new AbilitiesImport())
                ->withOutput($this->output)
                ->import(config('game.imports.dir') . Ability::IMPORT_SHEET);

            $this->output->success('Import successful!');
        } catch (Throwable $throwable) {
            report($throwable);

            if ($throwable instanceof ValidationException) {
                foreach ($throwable->failures() as $failure) {
                    $this->output->info($failure->row());
                    $this->output->info($failure->attribute());
                    $this->output->info($failure->errors());
                    $this->output->info($failure->values());
                }
            } else {
                $this->output->error($throwable->getMessage());
            }

            throw $throwable;
        }
    }
}
