<?php

namespace App\Console\Commands;

use App\Actions\GameLogic\Abilities\AssignUniversalAbilities;
use App\Models\GameLogic\Fighter;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class ImportGameDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import game data from a series of spreadsheets.';

    /**
     * Execute the console command.
     *
     * @throws \Throwable
     * @return void
     */
    public function handle(): void
    {
        $this->output->title('Starting import...');

        try {
            array_map(function (array $import) {
                $this->newLine();
                $this->info("Beginning import for {$import['name']}...");

                app($import['importer'])
                    ->withOutput($this->output)
                    ->import(
                        filePath: $import['file'],
                        readerType: $import['type'],
                    );
            }, config('imports.imports'));

            $this->newLine();
            $this->info('Importing universal abilities...');

            $action = app(AssignUniversalAbilities::class);
            $this->withProgressBar(Fighter::query()->cursor(), static function (Fighter $fighter) use ($action) {
                $action->execute($fighter);
            });

            $this->newLine();
            $this->info('Import complete!');
        } catch (ValidationException $exception) {
            foreach ($exception->failures() as $failure) {
                $this->output->warning("Row: {$failure->row()}");
                $this->output->warning("Attribute: {$failure->attribute()}");

                foreach ($failure->errors() as $error) {
                    $this->output->error("Errors: {$error}");
                }

                foreach ($failure->values() as $value) {
                    $this->output->info("Values: {$value}");
                }
            }

            throw $exception;
        } catch (Throwable $throwable) {
            $this->output->error($throwable->getMessage());

            throw $throwable;
        }
    }
}
